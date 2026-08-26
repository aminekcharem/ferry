<x-layouts.app title="CTN Request Details">
    @php
        $labels = ['Senior', 'Adult', 'Youth', 'Child', 'Baby', 'Newborn'];
        $brand = $message->vehicle_brand === 'Other' ? $message->vehicle_brand_other : $message->vehicle_brand;
        $model = $message->vehicle_model === 'Other' ? $message->vehicle_model_other : $message->vehicle_model;
        $infoClass = 'rounded-lg border border-slate-200 bg-white p-4';
        $statusClasses = [
            'pending' => 'border-amber-200 bg-amber-50 text-amber-800',
            'reserved' => 'border-emerald-200 bg-emerald-50 text-emerald-800',
            'cancelled' => 'border-red-200 bg-red-50 text-red-800',
        ];
    @endphp

    <section class="ui-shell py-8 lg:py-10">
        @if (session('status'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <span class="ui-badge">CTN Reservation #{{ $message->id }}</span>
                <h1 class="mt-3 flex flex-wrap items-center gap-3 text-3xl font-bold text-slate-950">
                    {{ $message->customer_name }}
                    <span class="inline-flex rounded-full border px-3 py-1 text-sm font-bold {{ $statusClasses[$message->status] ?? $statusClasses['pending'] }}">
                        {{ $message->statusLabel() }}
                    </span>
                </h1>
                <p class="mt-2 text-sm text-slate-600">Received on {{ $message->created_at->format('d/m/Y \a\t H:i') }}</p>
            </div>
            <a href="{{ route('backoffice.ctn-reservations.index') }}" class="ui-button-secondary">Back to list</a>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_380px]">
            <div class="space-y-6">
                <section class="ui-card p-5">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-slate-950">Request status</h2>
                            <p class="mt-1 text-sm text-slate-600">Every status change is recorded with a dated note.</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($statuses as $value => $label)
                                <button
                                    type="button"
                                    class="{{ $message->status === $value ? 'ui-button-primary' : 'ui-button-secondary' }}"
                                    data-status-button
                                    data-status-value="{{ $value }}"
                                    data-status-label="{{ $label }}"
                                >
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    @if ($errors->any())
                        <p class="mt-4 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm font-semibold text-red-700">
                            Please select a status and add a note before saving.
                        </p>
                    @endif
                </section>

                <section class="ui-card p-5">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-950">Client</h2>
                            <p class="mt-1 text-sm text-slate-600">Contact details and initial message.</p>
                        </div>
                    </div>
                    <dl class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div class="{{ $infoClass }}"><dt class="text-xs font-bold uppercase text-slate-500">Email</dt><dd class="mt-1 font-semibold text-primary"><a href="mailto:{{ $message->customer_email }}">{{ $message->customer_email }}</a></dd></div>
                        <div class="{{ $infoClass }}"><dt class="text-xs font-bold uppercase text-slate-500">Phone</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->customer_phone }}</dd></div>
                        <div class="{{ $infoClass }} sm:col-span-2"><dt class="text-xs font-bold uppercase text-slate-500">Message</dt><dd class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-800">{{ $message->customer_message ?: 'No message.' }}</dd></div>
                    </dl>
                </section>

                <section class="ui-card p-5">
                    <h2 class="text-xl font-bold text-slate-950">Trip</h2>
                    <dl class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="{{ $infoClass }}"><dt class="text-xs font-bold uppercase text-slate-500">Type</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->journey_type === 'round_trip' ? 'Round trip' : 'One way' }}</dd></div>
                        <div class="{{ $infoClass }}"><dt class="text-xs font-bold uppercase text-slate-500">Departure</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->departure_country }}</dd></div>
                        <div class="{{ $infoClass }}"><dt class="text-xs font-bold uppercase text-slate-500">Outward date</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->outward_date->format('d/m/Y') }}</dd></div>
                        <div class="{{ $infoClass }}"><dt class="text-xs font-bold uppercase text-slate-500">Return date</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->return_date?->format('d/m/Y') ?: '-' }}</dd></div>
                    </dl>
                </section>

                <section class="ui-card p-5">
                    <h2 class="text-xl font-bold text-slate-950">Passengers</h2>
                    <div class="mt-5 overflow-hidden rounded-lg border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50 text-left text-xs font-bold uppercase text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">Category</th>
                                    <th class="px-4 py-3">Outward</th>
                                    <th class="px-4 py-3">Return</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach ($labels as $index => $label)
                                    <tr>
                                        <td class="px-4 py-3 font-semibold text-slate-900">{{ $label }}</td>
                                        <td class="px-4 py-3 text-slate-700">{{ $message->outward_passengers[$index] ?? 0 }}</td>
                                        <td class="px-4 py-3 text-slate-700">{{ $message->return_passengers[$index] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>

                @if (! empty($message->passenger_details))
                    <section class="ui-card p-5">
                        <h2 class="text-xl font-bold text-slate-950">Passenger details</h2>
                        <div class="mt-5 space-y-4">
                            @foreach ($message->passenger_details as $direction => $categories)
                                @foreach ($categories as $categoryIndex => $passengers)
                                    @foreach ($passengers as $passengerIndex => $passenger)
                                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                                            <h3 class="text-sm font-bold text-slate-950">
                                                {{ $direction === 'return_extra' ? 'Return only' : ucfirst($direction) }}
                                                - {{ $labels[$categoryIndex] ?? 'Passenger' }} #{{ $passengerIndex + 1 }}
                                            </h3>
                                            <dl class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-5">
                                                <div><dt class="text-xs font-bold uppercase text-slate-500">Last name</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['last_name'] ?? '-' }}</dd></div>
                                                <div><dt class="text-xs font-bold uppercase text-slate-500">First name</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['first_name'] ?? '-' }}</dd></div>
                                                <div><dt class="text-xs font-bold uppercase text-slate-500">Date of birth</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['date_of_birth'] ?? '-' }}</dd></div>
                                                <div><dt class="text-xs font-bold uppercase text-slate-500">Gender</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['sexe'] ?? '-' }}</dd></div>
                                                <div><dt class="text-xs font-bold uppercase text-slate-500">Passport</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['passport_number'] ?? '-' }}</dd></div>
                                                <div><dt class="text-xs font-bold uppercase text-slate-500">Passport availability date</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['passport_availability_date'] ?? '-' }}</dd></div>
                                                @if (isset($passenger['will_return']))
                                                    <div><dt class="text-xs font-bold uppercase text-slate-500">Return</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['will_return'] === 'no' ? 'Different passenger' : 'Same passenger' }}</dd></div>
                                                @endif
                                            </dl>

                                            @if (! empty($passenger['return_replacement']))
                                                <div class="mt-4 rounded-lg border border-primary-100 bg-white p-4">
                                                    <h4 class="text-sm font-bold text-slate-950">Different return passenger</h4>
                                                    <dl class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-5">
                                                        <div><dt class="text-xs font-bold uppercase text-slate-500">Last name</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['return_replacement']['last_name'] ?? '-' }}</dd></div>
                                                        <div><dt class="text-xs font-bold uppercase text-slate-500">First name</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['return_replacement']['first_name'] ?? '-' }}</dd></div>
                                                        <div><dt class="text-xs font-bold uppercase text-slate-500">Date of birth</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['return_replacement']['date_of_birth'] ?? '-' }}</dd></div>
                                                        <div><dt class="text-xs font-bold uppercase text-slate-500">Gender</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['return_replacement']['sexe'] ?? '-' }}</dd></div>
                                                        <div><dt class="text-xs font-bold uppercase text-slate-500">Passport</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['return_replacement']['passport_number'] ?? '-' }}</dd></div>
                                                        <div><dt class="text-xs font-bold uppercase text-slate-500">Passport availability date</dt><dd class="text-sm font-semibold text-slate-950">{{ $passenger['return_replacement']['passport_availability_date'] ?? '-' }}</dd></div>
                                                    </dl>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </div>
                    </section>
                @endif

                <section class="ui-card p-5">
                    <h2 class="text-xl font-bold text-slate-950">Follow-up notes</h2>
                    @if ($message->statusNotes->isEmpty())
                        <p class="mt-4 rounded-lg bg-slate-50 p-4 text-sm text-slate-600">No notes have been added for this reservation yet.</p>
                    @else
                        <div class="mt-5 space-y-4">
                            @foreach ($message->statusNotes->sortByDesc('created_at') as $note)
                                <article class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                        <p class="text-sm font-bold text-slate-950">
                                            {{ $statuses[$note->from_status] ?? 'New' }} -> {{ $statuses[$note->to_status] ?? $note->to_status }}
                                        </p>
                                        <p class="text-xs font-semibold uppercase text-slate-500">
                                            {{ $note->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <p class="mt-2 text-sm font-semibold text-primary-700">{{ $note->user?->name ?? 'Deleted user' }}</p>
                                    <p class="mt-3 whitespace-pre-line text-sm leading-6 text-slate-700">{{ $note->note }}</p>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                <section class="ui-card p-5">
                    <h2 class="text-xl font-bold text-slate-950">Vehicle</h2>
                    <dl class="mt-5 space-y-4">
                        <div><dt class="text-xs font-bold uppercase text-slate-500">Brand / Model</dt><dd class="mt-1 font-semibold text-slate-950">{{ $brand }} {{ $model }}{{ $message->vehicle_year ? ' (' . $message->vehicle_year . ')' : '' }}</dd></div>
                        <div><dt class="text-xs font-bold uppercase text-slate-500">License plate</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->vehicle_license_number }}</dd></div>
                        <div><dt class="text-xs font-bold uppercase text-slate-500">Owner</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->vehicle_owner }}</dd></div>
                        <div><dt class="text-xs font-bold uppercase text-slate-500">Dimensions</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->vehicle_custom_dimensions ? "{$message->vehicle_length} x {$message->vehicle_width} x {$message->vehicle_height}" : 'Standard dimensions' }}</dd></div>
                    </dl>
                </section>

                <section class="ui-card p-5">
                    <h2 class="text-xl font-bold text-slate-950">Trailer</h2>
                    @if ($message->has_trailer)
                        <dl class="mt-5 space-y-4">
                            <div><dt class="text-xs font-bold uppercase text-slate-500">Type</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->trailer_type }}</dd></div>
                            <div><dt class="text-xs font-bold uppercase text-slate-500">Trip</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->trailer_outward ? 'Outward' : '' }} {{ $message->trailer_return ? 'Return' : '' }}</dd></div>
                            <div><dt class="text-xs font-bold uppercase text-slate-500">Dimensions</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->trailer_length }} x {{ $message->trailer_width }} x {{ $message->trailer_height }}</dd></div>
                            <div><dt class="text-xs font-bold uppercase text-slate-500">License plate</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->trailer_license_number ?: '-' }}</dd></div>
                            <div><dt class="text-xs font-bold uppercase text-slate-500">Owner</dt><dd class="mt-1 font-semibold text-slate-950">{{ $message->trailer_owner ?: '-' }}</dd></div>
                        </dl>
                    @else
                        <p class="mt-4 rounded-lg bg-slate-50 p-4 text-sm text-slate-600">No trailer reservation.</p>
                    @endif
                </section>
            </aside>
        </div>

        <dialog class="ui-modal w-[min(92vw,34rem)] rounded-lg border border-slate-200 bg-white p-0 shadow-xl" data-status-modal @if ($errors->any()) open @endif>
            <form method="POST" action="{{ route('backoffice.ctn-reservations.update-status', $message) }}" class="p-5">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="{{ old('status', $message->status) }}" data-status-input>

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-950">Add a status note</h2>
                        <p class="mt-1 text-sm text-slate-600">New status: <span class="font-bold text-slate-950" data-status-modal-label>{{ $statuses[old('status', $message->status)] ?? $message->statusLabel() }}</span></p>
                    </div>
                    <button type="button" class="ui-button-secondary min-h-9 px-3" data-status-modal-close>Close</button>
                </div>

                <label for="note" class="ui-label mt-5">Note</label>
                <textarea id="note" name="note" rows="5" required class="ui-input resize-y">{{ old('note') }}</textarea>
                @error('note')
                    <p class="mt-2 text-sm font-semibold text-red-700">{{ $message }}</p>
                @enderror

                <div class="mt-5 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                    <button type="button" class="ui-button-secondary" data-status-modal-close>Cancel</button>
                    <button type="submit" class="ui-button-primary">Save changes</button>
                </div>
            </form>
        </dialog>
    </section>
</x-layouts.app>
