<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBackofficeSettingsRequest;
use App\Services\ApplicationSettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BackofficeSettingController extends Controller
{
    public function __construct(private readonly ApplicationSettingService $settings) {}

    public function edit(): View
    {
        return view('backoffice.settings-edit', [
            'bookingNotificationEmails' => $this->settings->get(
                ApplicationSettingService::BOOKING_NOTIFICATION_EMAILS,
                config('ferry.booking_notification_emails', '')
            ),
        ]);
    }

    public function update(UpdateBackofficeSettingsRequest $request): RedirectResponse
    {
        $this->settings->set(
            ApplicationSettingService::BOOKING_NOTIFICATION_EMAILS,
            $request->normalizedBookingNotificationEmails()
        );

        return redirect()
            ->route('backoffice.settings.edit')
            ->with('status', 'Email notification settings have been updated.');
    }
}
