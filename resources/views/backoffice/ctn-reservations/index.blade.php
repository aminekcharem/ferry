<x-layouts.app title="CTN Requests">
    <section class="ui-shell py-8 lg:py-10">
        @php
            $statusClasses = [
                'pending' => 'border-amber-200 bg-amber-50 text-amber-800',
                'reserved' => 'border-emerald-200 bg-emerald-50 text-emerald-800',
                'cancelled' => 'border-red-200 bg-red-50 text-red-800',
            ];
        @endphp

        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <span class="ui-badge">Backoffice</span>
                <h1 class="mt-3 flex flex-wrap items-center gap-3 text-3xl font-bold text-slate-950">
                    CTN reservation requests
                    @if ($unreadCount > 0)
                        <span class="inline-flex min-w-7 items-center justify-center rounded-full bg-red-600 px-2.5 py-1 text-xs font-bold text-white">
                            {{ $unreadCount }} new
                        </span>
                    @endif
                </h1>
                <p class="mt-2 text-sm text-slate-600">{{ $messages->total() }} total request{{ $messages->total() > 1 ? 's' : '' }}.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="ui-button-secondary">Back to dashboard</a>
        </div>

        <form method="GET" action="{{ route('backoffice.ctn-reservations.index') }}" class="ui-card mb-6 p-5">
            <div class="grid gap-4 md:grid-cols-4">
                <div>
                    <label for="date_from" class="ui-label">Received from</label>
                    <input id="date_from" name="date_from" type="date" value="{{ $filters['date_from'] ?? '' }}" class="ui-input">
                </div>
                <div>
                    <label for="date_to" class="ui-label">Received to</label>
                    <input id="date_to" name="date_to" type="date" value="{{ $filters['date_to'] ?? '' }}" class="ui-input">
                </div>
                <div>
                    <label for="status" class="ui-label">Reservation status</label>
                    <select id="status" name="status" class="ui-input">
                        <option value="">All statuses</option>
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="ui-button-primary w-full">Apply filters</button>
                    <a href="{{ route('backoffice.ctn-reservations.index') }}" class="ui-button-secondary w-full">Clear</a>
                </div>
            </div>
        </form>

        <div class="ui-card overflow-hidden">
            @if ($messages->isEmpty())
                <div class="p-10 text-center">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-md bg-slate-100 text-xl font-bold text-slate-500">0</span>
                    <h2 class="mt-4 text-lg font-bold text-slate-950">No CTN requests</h2>
                    <p class="mt-2 text-sm text-slate-600">Requests submitted from the form will appear here.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-left text-xs font-bold uppercase text-slate-500">
                            <tr>
                                <th class="px-5 py-4">Client</th>
                                <th class="px-5 py-4">Contact</th>
                                <th class="px-5 py-4">Itinerary</th>
                                <th class="px-5 py-4">Vehicle</th>
                                <th class="px-5 py-4">Status</th>
                                <th class="px-5 py-4">Received</th>
                                <th class="px-5 py-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach ($messages as $message)
                                @php
                                    $brand = $message->vehicle_brand === 'Other' ? $message->vehicle_brand_other : $message->vehicle_brand;
                                    $model = $message->vehicle_model === 'Other' ? $message->vehicle_model_other : $message->vehicle_model;
                                @endphp
                                <tr class="align-top transition hover:bg-primary-50/40">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md {{ $message->viewed_at === null ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-600' }} text-xs font-bold" title="{{ $message->viewed_at === null ? 'New reservation' : 'Viewed reservation' }}">
                                                {{ strtoupper(mb_substr($message->customer_name, 0, 2)) }}
                                            </span>
                                            <div>
                                                <p class="font-bold text-slate-950">{{ $message->customer_name }}</p>
                                                <p class="mt-1 text-xs text-slate-500">#{{ $message->id }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700">
                                        <a href="mailto:{{ $message->customer_email }}" class="font-semibold text-primary">{{ $message->customer_email }}</a>
                                        <div class="mt-1">{{ $message->customer_phone }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700">
                                        <div class="font-semibold text-slate-900">{{ $message->departure_country }}</div>
                                        <div class="mt-1">{{ $message->journey_type === 'round_trip' ? 'Round trip' : 'One way' }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700">
                                        <div class="font-semibold text-slate-900">{{ $brand ?: '-' }}</div>
                                        <div class="mt-1">{{ $model ?: '-' }}</div>
                                        @if ($message->vehicle_year)
                                            <div class="mt-1 text-xs text-slate-500">{{ $message->vehicle_year }}</div>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex rounded-full border px-2.5 py-1 text-xs font-bold {{ $statusClasses[$message->status] ?? $statusClasses['pending'] }}">
                                            {{ $message->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700">
                                        <div class="font-semibold text-slate-900">{{ $message->created_at->format('d/m/Y') }}</div>
                                        <div class="mt-1 text-xs text-slate-500">{{ $message->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('backoffice.ctn-reservations.show', $message) }}" class="ui-button-secondary">Open</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </section>
</x-layouts.app>
