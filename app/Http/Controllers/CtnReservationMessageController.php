<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCtnReservationMessageRequest;
use App\Http\Requests\UpdateCtnReservationStatusRequest;
use App\Models\CtnReservationMessage;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CtnReservationMessageController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $filters = $request->validate([
            'date_from' => ['nullable', 'date_format:d/m/Y'],
            'date_to' => ['nullable', 'date_format:d/m/Y'],
            'status' => ['nullable', 'string', 'in:pending,reserved,cancelled'],
        ]);
        $dateFrom = $this->dateFilterForQuery($filters['date_from'] ?? null);
        $dateTo = $this->dateFilterForQuery($filters['date_to'] ?? null);

        if ($dateFrom !== null && $dateTo !== null && $dateTo < $dateFrom) {
            return back()
                ->withInput()
                ->withErrors(['date_to' => 'The received to date must be after or equal to the received from date.']);
        }

        $messagesQuery = CtnReservationMessage::query()
            ->when($dateFrom, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when($dateTo, fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status));

        $unreadCount = CtnReservationMessage::unread()->count();

        return view('backoffice.ctn-reservations.index', [
            'messages' => $messagesQuery->latest()->paginate(15)->withQueryString(),
            'unreadCount' => $unreadCount,
            'filters' => $filters,
            'statuses' => CtnReservationMessage::STATUSES,
        ]);
    }

    public function show(CtnReservationMessage $ctnReservationMessage): View
    {
        if ($ctnReservationMessage->viewed_at === null) {
            $ctnReservationMessage->forceFill(['viewed_at' => now()])->save();
        }

        return view('backoffice.ctn-reservations.show', [
            'message' => $ctnReservationMessage->load(['statusNotes.user']),
            'statuses' => CtnReservationMessage::STATUSES,
        ]);
    }

    public function updateStatus(
        UpdateCtnReservationStatusRequest $request,
        CtnReservationMessage $ctnReservationMessage
    ): RedirectResponse {
        $data = $request->validated();
        $previousStatus = $ctnReservationMessage->status;

        DB::transaction(function () use ($ctnReservationMessage, $data, $previousStatus, $request): void {
            $ctnReservationMessage->forceFill([
                'status' => $data['status'],
            ])->save();

            $ctnReservationMessage->statusNotes()->create([
                'user_id' => $request->user()->id,
                'from_status' => $previousStatus,
                'to_status' => $data['status'],
                'note' => $data['note'],
            ]);
        });

        return redirect()
            ->route('backoffice.ctn-reservations.show', $ctnReservationMessage)
            ->with('status', 'The reservation status has been updated.');
    }

    public function store(StoreCtnReservationMessageRequest $request): RedirectResponse
    {
        $data = $request->validatedForStorage();
        $isRoundTrip = $data['journey_type'] === 'round_trip';
        $hasTrailer = $request->boolean('has_trailer');
        $hasVehicleDimensions = $request->boolean('vehicle_custom_dimensions');

        CtnReservationMessage::create(array_merge($data, [
            'return_date' => $isRoundTrip ? ($data['return_date'] ?? null) : null,
            'return_passengers' => $isRoundTrip ? ($data['return_passengers'] ?? null) : null,
            'vehicle_custom_dimensions' => $hasVehicleDimensions,
            'vehicle_length' => $hasVehicleDimensions ? ($data['vehicle_length'] ?? null) : null,
            'vehicle_width' => $hasVehicleDimensions ? ($data['vehicle_width'] ?? null) : null,
            'vehicle_height' => $hasVehicleDimensions ? ($data['vehicle_height'] ?? null) : null,
            'has_trailer' => $hasTrailer,
            'trailer_outward' => $hasTrailer && $request->boolean('trailer_outward'),
            'trailer_return' => $hasTrailer && $isRoundTrip && $request->boolean('trailer_return'),
            'trailer_type' => $hasTrailer ? ($data['trailer_type'] ?? null) : null,
            'trailer_length' => $hasTrailer ? ($data['trailer_length'] ?? null) : null,
            'trailer_width' => $hasTrailer ? ($data['trailer_width'] ?? null) : null,
            'trailer_height' => $hasTrailer ? ($data['trailer_height'] ?? null) : null,
            'trailer_license_number' => $hasTrailer ? ($data['trailer_license_number'] ?? null) : null,
            'trailer_owner' => $hasTrailer ? ($data['trailer_owner'] ?? null) : null,
            'height_acceptance' => true,
            'submitted_ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]));

        return redirect()
            ->route('reservation.ctn')
            ->with('status', 'Your ferry reservation request has been sent.');
    }

    private function dateFilterForQuery(?string $date): ?string
    {
        if ($date === null || $date === '') {
            return null;
        }

        return CarbonImmutable::createFromFormat('!d/m/Y', $date)->format('Y-m-d');
    }
}
