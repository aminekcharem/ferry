<x-layouts.app title="Ferry Reservation">
    <section class="ui-shell py-8 lg:py-10">
        @php
            $reservationSuccessMessage = session('status')
                ?: (request()->boolean('reservation_sent') ? 'Your ferry reservation request has been sent.' : null);

            $htmlDate = function (?string $value): string {
                if (blank($value)) {
                    return '';
                }

                foreach (['Y-m-d', 'd/m/Y'] as $format) {
                    try {
                        $date = \Carbon\CarbonImmutable::createFromFormat('!' . $format, $value);
                    } catch (\InvalidArgumentException) {
                        continue;
                    }

                    if ($date->format($format) === $value) {
                        return $date->format('Y-m-d');
                    }
                }

                return '';
            };

            $ctnRoutes = [
                'Tunisia - Gênes',
                'Tunisia - Civitavecchia',
                'Tunisia - Palerme (Sicile)',
                'Tunisia - Marseille',
                'Gênes - Tunisia',
                'Civitavecchia - Tunisia',
                'Palerme (Sicile) - Tunisia',
                'Marseille - Tunisia',
            ];
        @endphp

        <div class="mb-6 grid gap-4 lg:grid-cols-[1fr_auto] lg:items-end">
            <div>
                <span class="ui-badge">Booking Form</span>
                <h1 class="mt-3 text-3xl font-bold text-slate-950">Ferry reservation with vehicle</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Enter the itinerary, passengers, and vehicle information. Passenger details appear automatically based on the selected quantities.</p>
            </div>
            @unless (request()->boolean('embed'))
                <a href="{{ url('/') }}" class="ui-button-secondary">
                    <x-icon name="chevron-left" />
                    <span>Back to home</span>
                </a>
            @endunless
        </div>

        @if ($reservationSuccessMessage)
            <dialog class="ui-modal reservation-success-modal w-[min(92vw,28rem)] rounded-lg border border-emerald-100 bg-white p-0 text-left shadow-xl" data-reservation-success-modal aria-labelledby="reservation-success-title">
                <div class="relative overflow-hidden p-6 text-center sm:p-7">
                    <button type="button" class="absolute right-3 top-3 inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-500 transition hover:bg-slate-100 hover:text-slate-800" data-reservation-success-close aria-label="Close confirmation">
                        <x-icon name="x" class="h-5 w-5" />
                    </button>

                    <div class="reservation-success-icon mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 ring-8 ring-emerald-50/70">
                        <x-icon name="check" class="h-8 w-8" />
                    </div>

                    <h2 id="reservation-success-title" class="mt-5 text-xl font-bold text-slate-950">Request sent</h2>
                    <p class="mt-3 text-sm font-semibold leading-6 text-emerald-700">
                        {{ $reservationSuccessMessage }}
                    </p>
                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Our team will review the reservation details and contact you shortly.
                    </p>

                    <button type="button" class="ui-button-primary mt-6 w-full" data-reservation-success-close>
                        <x-icon name="check" />
                        <span>Done</span>
                    </button>
                </div>
            </dialog>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="font-semibold">Please check the form information.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="ctn-reservation-form" action="{{ route('reservation.ctn.store', request()->boolean('embed') ? ['embed' => 1] : []) }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid gap-6 lg:grid-cols-[1fr_380px]">
                <div class="space-y-6">
                    <section class="ui-card p-5">
                        <div class="flex items-start gap-3">
                            <span class="ui-step">1</span>
                            <div>
                                <h2 class="text-xl font-bold text-slate-950">Client</h2>
                                <p class="mt-1 text-sm text-slate-600">Contact details used to follow up with the requester.</p>
                            </div>
                        </div>
                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="customer_name" class="ui-label">Full name</label>
                                <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name') }}" required autocomplete="name" class="ui-input">
                                @error('customer_name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="customer_email" class="ui-label">Email</label>
                                <input id="customer_email" name="customer_email" type="email" value="{{ old('customer_email') }}" required autocomplete="email" class="ui-input">
                                @error('customer_email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="customer_phone" class="ui-label">Phone</label>
                                <input id="customer_phone" name="customer_phone" type="text" value="{{ old('customer_phone') }}" required autocomplete="tel" class="ui-input">
                                @error('customer_phone')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="customer_message" class="ui-label">Message</label>
                                <textarea id="customer_message" name="customer_message" rows="3" class="ui-input">{{ old('customer_message') }}</textarea>
                                @error('customer_message')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </section>

                    <section class="ui-card p-5">
                        <div class="flex items-start gap-3">
                            <span class="ui-step">2</span>
                            <div>
                                <h2 class="text-xl font-bold text-slate-950">Itinerary</h2>
                                <p class="mt-1 text-sm text-slate-600">Trip type, departure country, and dates.</p>
                            </div>
                        </div>
                        <div class="mt-5 space-y-5">
                            <div>
                                <p class="ui-label">Trip type</p>
                                <div class="mt-2 grid gap-3 sm:grid-cols-2">
                                    <label class="flex min-h-12 cursor-pointer items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-800 transition has-[:checked]:border-primary has-[:checked]:bg-primary has-[:checked]:text-white">
                                        <input type="radio" name="journey_type" value="one_way" class="sr-only" @checked(old('journey_type', 'one_way') === 'one_way')>
                                        One way
                                    </label>
                                    <label class="flex min-h-12 cursor-pointer items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-800 transition has-[:checked]:border-primary has-[:checked]:bg-primary has-[:checked]:text-white">
                                        <input type="radio" name="journey_type" value="round_trip" class="sr-only" @checked(old('journey_type') === 'round_trip')>
                                        Round trip
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label for="departure_country" class="ui-label">Departure country</label>
                                <select id="departure_country" name="departure_country" required class="ui-input">
                                    <option value="">Select</option>
                                    @foreach ($ctnRoutes as $route)
                                        <option value="{{ $route }}" @selected(old('departure_country') === $route)>{{ $route }}</option>
                                    @endforeach
                                </select>
                                @error('departure_country')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div data-return-country>
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <label for="return_country" class="ui-label">Return country</label>
                                    <label class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700">
                                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary-100" data-same-return-destination>
                                        <span>Same return destination</span>
                                    </label>
                                </div>
                                <input type="hidden" name="return_country" value="" disabled data-return-country-hidden>
                                <select id="return_country" name="return_country" class="ui-input">
                                    <option value="">Select</option>
                                    @foreach ($ctnRoutes as $route)
                                        <option value="{{ $route }}" @selected(old('return_country') === $route)>{{ $route }}</option>
                                    @endforeach
                                </select>
                                @error('return_country')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="outward_date" class="ui-label">Outward date</label>
                                    <input id="outward_date" name="outward_date" type="date" value="{{ $htmlDate(old('outward_date')) }}" required data-travel-date class="ui-input">
                                    @error('outward_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                                <div data-return-date>
                                    <label for="return_date" class="ui-label">Return date</label>
                                    <input id="return_date" name="return_date" type="date" value="{{ $htmlDate(old('return_date')) }}" data-travel-date class="ui-input">
                                    @error('return_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="ui-card p-5">
                        <div class="flex items-start gap-3">
                            <span class="ui-step">3</span>
                            <div class="flex-1">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                    <div>
                                        <h2 class="text-xl font-bold text-slate-950">Passengers</h2>
                                        <p class="mt-1 text-sm text-slate-600">Adjust quantities by category.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 divide-y divide-slate-200 overflow-hidden rounded-lg border border-slate-200">
                            <div class="hidden bg-white px-3 pt-3 sm:grid sm:grid-cols-[1fr_auto_auto] sm:items-center sm:gap-3">
                                <span aria-hidden="true"></span>
                                <span class="w-36 text-center text-xs font-bold uppercase text-slate-500">Outward</span>
                                <span data-return-column-label class="w-36 text-center text-xs font-bold uppercase text-slate-500">Return</span>
                            </div>
                            @foreach ([
                                'Senior (60 to 102 years)',
                                'Adult(s) (25 to 60 years)',
                                'Youth (15 to 25 years)',
                                'Child (02 to 15 years)',
                                'Baby/Babies (01 to 02 years)',
                                'Newborn(s) (0 to 01 years)',
                            ] as $passenger)
                                <div class="grid gap-3 bg-white p-3 sm:grid-cols-[1fr_auto_auto] sm:items-center" data-passenger-row data-passenger-category="{{ $passenger }}">
                                    <span class="text-sm font-semibold text-slate-800">{{ $passenger }}</span>
                                    <div class="grid grid-cols-[minmax(4.5rem,1fr)_auto] items-center gap-3 sm:block" data-passenger-direction="outward">
                                        <span class="text-xs font-bold uppercase text-slate-500 sm:sr-only">Outward</span>
                                        <div class="flex items-center gap-2">
                                            <button type="button" data-counter-minus class="h-9 w-9 rounded-md border border-slate-300 text-lg font-bold text-slate-600 hover:bg-slate-100" aria-label="Remove passenger">-</button>
                                            <input type="number" name="outward_passengers[]" min="0" value="{{ old('outward_passengers.' . $loop->index, 0) }}" class="h-9 w-14 rounded-md border border-slate-300 text-center text-sm font-bold text-slate-950">
                                            <button type="button" data-counter-plus class="h-9 w-9 rounded-md bg-primary text-lg font-bold text-white hover:bg-primary-700" aria-label="Add passenger">+</button>
                                        </div>
                                    </div>
                                    <div data-return-passenger data-passenger-direction="return" class="grid grid-cols-[minmax(4.5rem,1fr)_auto] items-center gap-3 sm:block">
                                        <span class="text-xs font-bold uppercase text-slate-500 sm:sr-only">Return</span>
                                        <div class="flex items-center gap-2">
                                            <button type="button" data-counter-minus class="h-9 w-9 rounded-md border border-slate-300 text-lg font-bold text-slate-600 hover:bg-slate-100" aria-label="Remove return passenger">-</button>
                                            <input type="number" name="return_passengers[]" min="0" value="{{ old('return_passengers.' . $loop->index, 0) }}" class="h-9 w-14 rounded-md border border-slate-300 text-center text-sm font-bold text-slate-950">
                                            <button type="button" data-counter-plus class="h-9 w-9 rounded-md bg-primary text-lg font-bold text-white hover:bg-primary-700" aria-label="Add return passenger">+</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5 ui-panel p-4" data-passenger-details-wrapper hidden>
                            <h3 class="text-base font-bold text-slate-950">Passenger details</h3>
                            <div class="mt-4 space-y-4" data-passenger-details></div>
                        </div>
                    </section>
                </div>

                <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
                    <section class="ui-card p-5">
                        <div class="flex items-start gap-3">
                            <span class="ui-step">4</span>
                            <div>
                                <h2 class="text-xl font-bold text-slate-950">Vehicle</h2>
                                <p class="mt-1 text-sm text-slate-600">Technical information and owner details.</p>
                            </div>
                        </div>
                        <div class="mt-5 space-y-4">
                            <div>
                                <label for="vehicle_brand" class="ui-label">Brand</label>
                                <select id="vehicle_brand" name="vehicle_brand" required data-selected-value="{{ old('vehicle_brand') }}" class="ui-input">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div data-other-brand hidden>
                                <label for="vehicle_brand_other" class="ui-label">Other brand</label>
                                <input id="vehicle_brand_other" name="vehicle_brand_other" type="text" value="{{ old('vehicle_brand_other') }}" class="ui-input">
                            </div>
                            <div>
                                <label for="vehicle_model" class="ui-label">Model</label>
                                <select id="vehicle_model" name="vehicle_model" required disabled data-selected-value="{{ old('vehicle_model') }}" class="ui-input">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div data-other-model hidden>
                                <label for="vehicle_model_other" class="ui-label">Other model</label>
                                <input id="vehicle_model_other" name="vehicle_model_other" type="text" value="{{ old('vehicle_model_other') }}" class="ui-input">
                            </div>
                            <div>
                                <label for="vehicle_year" class="ui-label">Model year</label>
                                <select id="vehicle_year" name="vehicle_year" data-selected-year="{{ old('vehicle_year') }}" disabled class="ui-input">
                                    <option value="">Select year</option>
                                </select>
                                <label data-vehicle-year-manual-toggle-wrapper class="mt-3 flex items-center gap-2 text-sm font-semibold text-slate-800" hidden>
                                    <input id="vehicle_year_manual_toggle" type="checkbox" data-vehicle-year-manual-toggle class="h-4 w-4 rounded border-slate-300 text-primary">
                                    Enter model year manually
                                </label>
                                <div data-vehicle-year-manual hidden>
                                    <label for="vehicle_year_manual" class="ui-label mt-3">Enter model year</label>
                                    <input id="vehicle_year_manual" name="vehicle_year" type="text" maxlength="4" inputmode="numeric" pattern="\d{4}" placeholder="YYYY" value="{{ old('vehicle_year') }}" disabled class="ui-input">
                                </div>
                            </div>
                            <div class="ui-panel p-5">
                                <label class="flex items-start gap-3 text-sm font-semibold text-slate-900">
                                    <input type="checkbox" name="vehicle_custom_dimensions" value="1" data-vehicle-dimensions-toggle @checked(old('vehicle_custom_dimensions')) class="mt-1 h-4 w-4 rounded border-slate-300 text-primary">
                                    Vehicle dimensions differ from the standard values
                                </label>
                                <div data-vehicle-dimensions class="mt-4 grid gap-3" hidden>
                                    <div>
                                        <label for="vehicle_length" class="ui-label">Length</label>
                                        <input id="vehicle_length" name="vehicle_length" type="number" step="0.01" min="0" value="{{ old('vehicle_length', '4.50') }}" disabled class="ui-input">
                                    </div>
                                    <div>
                                        <label for="vehicle_height" class="ui-label">Height</label>
                                        <input id="vehicle_height" name="vehicle_height" type="number" step="0.01" min="0" value="{{ old('vehicle_height', '1.70') }}" disabled class="ui-input">
                                    </div>
                                    <div>
                                        <label for="vehicle_width" class="ui-label">Width</label>
                                        <input id="vehicle_width" name="vehicle_width" type="number" step="0.01" min="0" value="{{ old('vehicle_width', '1.80') }}" disabled class="ui-input">
                                    </div>
                                </div>
                            </div>
                            <div class="ui-panel p-5">
                                <label class="flex items-center gap-3 text-sm font-bold text-slate-950">
                                    <input type="checkbox" name="has_roof_box" value="1" data-roof-box-toggle @checked(old('has_roof_box')) class="h-4 w-4 rounded border-slate-300 text-primary">
                                    Roof box
                                </label>
                                <div data-roof-box-panel class="mt-5 space-y-4" hidden>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="flex items-start gap-2 text-sm font-semibold text-slate-800">
                                                <input type="checkbox" name="has_roof_extra" value="1" data-extra-dimension-toggle data-extra-dimension-target="height" @checked(old('has_roof_extra')) class="mt-1 h-4 w-4 rounded border-slate-300 text-primary">
                                                Something on the roof, e.g. roof box, bikes etc?
                                            </label>
                                            <div data-extra-dimension-select-wrapper="height" class="mt-3" hidden>
                                                <label for="roof_extra_height" class="ui-label">Extra height</label>
                                                <select id="roof_extra_height" name="roof_extra_height" data-extra-dimension-select data-extra-dimension-target="height" data-selected-value="{{ old('roof_extra_height') }}" disabled class="ui-input">
                                                    @foreach ([['0.50', 'up to 0.5'], ['1.00', 'up to 1.00']] as [$value, $label])
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="flex items-start gap-2 text-sm font-semibold text-slate-800">
                                                <input type="checkbox" name="has_back_extra" value="1" data-extra-dimension-toggle data-extra-dimension-target="length" @checked(old('has_back_extra')) class="mt-1 h-4 w-4 rounded border-slate-300 text-primary">
                                                Something on the back, e.g. bikes, luggage etc?
                                            </label>
                                            <div data-extra-dimension-select-wrapper="length" class="mt-3" hidden>
                                                <label for="back_extra_length" class="ui-label">Extra length</label>
                                                <select id="back_extra_length" name="back_extra_length" data-extra-dimension-select data-extra-dimension-target="length" data-selected-value="{{ old('back_extra_length') }}" disabled class="ui-input">
                                                    @foreach ([['0.50', 'up to 0.5'], ['1.00', 'up to 1.00']] as [$value, $label])
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ui-panel p-5">
                                <label class="flex items-center gap-3 text-sm font-bold text-slate-950">
                                    <input type="checkbox" name="has_trailer" value="1" data-trailer-toggle @checked(old('has_trailer')) class="h-4 w-4 rounded border-slate-300 text-primary">
                                    Trailer reservation
                                </label>
                                <div data-trailer-panel class="mt-5 space-y-4" hidden>
                                    <div class="grid gap-3 sm:grid-cols-2">
                                        <label class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                                            <input type="checkbox" name="trailer_outward" value="1" @checked(old('trailer_outward', '1'))>
                                            Outward
                                        </label>
                                        <label data-trailer-return class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                                            <input type="checkbox" name="trailer_return" value="1" @checked(old('trailer_return', '1'))>
                                            Return
                                        </label>
                                    </div>
                                    <div class="grid gap-2">
                                        @foreach (['Trailer', 'Boat trailer', 'Caravan'] as $type)
                                            <label class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                                                <input type="radio" name="trailer_type" value="{{ $type }}" @checked(old('trailer_type') === $type) disabled>
                                                {{ $type }}
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="grid gap-3 sm:grid-cols-3 lg:grid-cols-1">
                                        <input name="trailer_length" type="number" step="0.01" min="0" value="{{ old('trailer_length') }}" placeholder="Length" class="ui-input mt-0">
                                        <input name="trailer_height" type="number" step="0.01" min="0" value="{{ old('trailer_height') }}" placeholder="Height" class="ui-input mt-0">
                                        <input name="trailer_width" type="number" step="0.01" min="0" value="{{ old('trailer_width') }}" placeholder="Width" class="ui-input mt-0">
                                    </div>
                                    <input name="trailer_license_number" type="text" value="{{ old('trailer_license_number') }}" placeholder="Trailer license plate" class="ui-input">
                                    <input name="trailer_owner" type="text" value="{{ old('trailer_owner') }}" placeholder="Trailer owner" class="ui-input">
                                </div>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                                <div>
                                    <label for="vehicle_license_number" class="ui-label">License plate</label>
                                    <input id="vehicle_license_number" name="vehicle_license_number" type="text" value="{{ old('vehicle_license_number') }}" required class="ui-input">
                                </div>
                                <div>
                                    <label for="vehicle_owner" class="ui-label">Owner</label>
                                    <input id="vehicle_owner" name="vehicle_owner" type="text" value="{{ old('vehicle_owner') }}" required class="ui-input">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-lg border border-amber-200 bg-amber-50 p-5 text-amber-950">
                        <h2 class="font-bold">Vehicle height confirmation</h2>
                        <p class="mt-2 text-sm leading-6">
                            The height must be accurate. An error may lead to additional port fees or boarding refusal.
                        </p>
                        <label class="mt-4 flex items-start gap-3 text-sm font-bold">
                            <input type="checkbox" name="height_acceptance" value="1" required class="mt-1 h-4 w-4 rounded border-amber-300 text-primary">
                            I confirm that the vehicle height has been entered correctly.
                        </label>
                    </section>

                    <button type="submit" class="ui-button-primary reservation-submit-loader w-full py-3" data-reservation-submit aria-busy="false">
                        <span class="reservation-submit-spinner" aria-hidden="true"></span>
                        <span data-submit-default class="inline-flex items-center gap-2">
                            <x-icon name="ship" />
                            <span>Send ferry request</span>
                        </span>
                        <span data-submit-loading class="hidden">Sending request...</span>
                    </button>
                </aside>
            </div>
        </form>
        <script type="application/json" id="ctn-validation-errors">@json($errors->messages())</script>
        <script type="application/json" id="ctn-old-input">@json(old())</script>
    </section>
</x-layouts.app>
