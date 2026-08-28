@php
    $passengerLabels = ['Senior', 'Adult', 'Youth', 'Child', 'Baby', 'Newborn'];
    $brand = $reservation->vehicle_brand === 'Other' ? $reservation->vehicle_brand_other : $reservation->vehicle_brand;
    $model = $reservation->vehicle_model === 'Other' ? $reservation->vehicle_model_other : $reservation->vehicle_model;
    $fieldStyle = 'padding:10px 12px;border-bottom:1px solid #e5e7eb;vertical-align:top;';
    $labelStyle = $fieldStyle . 'width:38%;color:#475569;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.03em;background:#f8fafc;';
    $valueStyle = $fieldStyle . 'color:#0f172a;font-size:14px;font-weight:600;';
    $sectionStyle = 'margin:0 0 18px;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;background:#ffffff;';
    $sectionTitleStyle = 'margin:0;padding:13px 16px;background:#0f766e;color:#ffffff;font-size:16px;line-height:22px;font-weight:700;';
    $muted = 'color:#64748b;font-size:13px;line-height:20px;';
    $formatDate = fn ($date) => $date ? $date->format('d/m/Y') : '-';
    $formatPassengerDate = function (?string $date): string {
        if (blank($date)) {
            return '-';
        }

        foreach (['d/m/Y', 'Y-m-d'] as $format) {
            try {
                $parsedDate = \Carbon\CarbonImmutable::createFromFormat('!' . $format, $date);
            } catch (\InvalidArgumentException) {
                continue;
            }

            if ($parsedDate->format($format) === $date) {
                return $parsedDate->format('d/m/Y');
            }
        }

        return $date;
    };
    $yesNo = fn (bool $value) => $value ? 'Yes' : 'No';
    $tripType = $reservation->journey_type === 'round_trip' ? 'Round trip' : 'One way';
    $trailerTrip = trim(($reservation->trailer_outward ? 'Outward ' : '') . ($reservation->trailer_return ? 'Return' : ''));
@endphp

<div style="margin:0;background:#f1f5f9;padding:24px;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">
    <div style="max-width:760px;margin:0 auto;">
        <div style="margin:0 0 18px;padding:22px;border-radius:8px;background:#ffffff;border:1px solid #e2e8f0;">
            <p style="margin:0 0 8px;color:#0f766e;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;">Ferry reservation</p>
            <h1 style="margin:0;color:#0f172a;font-size:24px;line-height:32px;">New request #{{ $reservation->id }}</h1>
            <p style="margin:10px 0 0;{{ $muted }}">A new ferry reservation request has been submitted from the website.</p>
        </div>

        <div style="{{ $sectionStyle }}">
            <h2 style="{{ $sectionTitleStyle }}">Client</h2>
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                <tr><td style="{{ $labelStyle }}">Full name</td><td style="{{ $valueStyle }}">{{ $reservation->customer_name }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Email</td><td style="{{ $valueStyle }}"><a href="mailto:{{ $reservation->customer_email }}" style="color:#0f766e;">{{ $reservation->customer_email }}</a></td></tr>
                <tr><td style="{{ $labelStyle }}">Phone</td><td style="{{ $valueStyle }}">{{ $reservation->customer_phone }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Message</td><td style="{{ $valueStyle }}font-weight:400;white-space:pre-line;">{{ $reservation->customer_message ?: '-' }}</td></tr>
            </table>
        </div>

        <div style="{{ $sectionStyle }}">
            <h2 style="{{ $sectionTitleStyle }}">Trip</h2>
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                <tr><td style="{{ $labelStyle }}">Trip type</td><td style="{{ $valueStyle }}">{{ $tripType }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Departure country</td><td style="{{ $valueStyle }}">{{ $reservation->departure_country }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Outward date</td><td style="{{ $valueStyle }}">{{ $formatDate($reservation->outward_date) }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Return date</td><td style="{{ $valueStyle }}">{{ $formatDate($reservation->return_date) }}</td></tr>
            </table>
        </div>

        <div style="{{ $sectionStyle }}">
            <h2 style="{{ $sectionTitleStyle }}">Passenger quantities</h2>
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th align="left" style="{{ $labelStyle }}">Category</th>
                        <th align="left" style="{{ $labelStyle }}">Outward</th>
                        <th align="left" style="{{ $labelStyle }}">Return</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($passengerLabels as $index => $label)
                        <tr>
                            <td style="{{ $valueStyle }}">{{ $label }}</td>
                            <td style="{{ $valueStyle }}">{{ $reservation->outward_passengers[$index] ?? 0 }}</td>
                            <td style="{{ $valueStyle }}">{{ $reservation->return_passengers[$index] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="{{ $sectionStyle }}">
            <h2 style="{{ $sectionTitleStyle }}">Passenger details</h2>
            @if (! empty($reservation->passenger_details))
                <div style="padding:14px 16px;">
                    @foreach ($reservation->passenger_details as $direction => $categories)
                        @foreach ($categories as $categoryIndex => $passengers)
                            @foreach ($passengers as $passengerIndex => $passenger)
                                <div style="margin:0 0 12px;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;">
                                    <p style="margin:0;padding:10px 12px;background:#f8fafc;color:#0f172a;font-size:14px;font-weight:700;">
                                        {{ $direction === 'return_extra' ? 'Return only' : ucfirst($direction) }}
                                        - {{ $passengerLabels[$categoryIndex] ?? 'Passenger' }} #{{ $passengerIndex + 1 }}
                                    </p>
                                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                                        <tr><td style="{{ $labelStyle }}">Last name</td><td style="{{ $valueStyle }}">{{ $passenger['last_name'] ?? '-' }}</td></tr>
                                        <tr><td style="{{ $labelStyle }}">First name</td><td style="{{ $valueStyle }}">{{ $passenger['first_name'] ?? '-' }}</td></tr>
                                        <tr><td style="{{ $labelStyle }}">Date of birth</td><td style="{{ $valueStyle }}">{{ $formatPassengerDate($passenger['date_of_birth'] ?? null) }}</td></tr>
                                        <tr><td style="{{ $labelStyle }}">Gender</td><td style="{{ $valueStyle }}">{{ $passenger['sexe'] ?? '-' }}</td></tr>
                                        <tr><td style="{{ $labelStyle }}">Passport</td><td style="{{ $valueStyle }}">{{ $passenger['passport_number'] ?? '-' }}</td></tr>
                                        <tr><td style="{{ $labelStyle }}">Passport availability date</td><td style="{{ $valueStyle }}">{{ $formatPassengerDate($passenger['passport_availability_date'] ?? null) }}</td></tr>
                                        @if (isset($passenger['will_return']))
                                            <tr><td style="{{ $labelStyle }}">Return</td><td style="{{ $valueStyle }}">{{ $passenger['will_return'] === 'no' ? 'Different passenger' : 'Same passenger' }}</td></tr>
                                        @endif
                                    </table>

                                    @if (! empty($passenger['return_replacement']))
                                        <p style="margin:0;padding:10px 12px;background:#ecfdf5;color:#0f766e;font-size:13px;font-weight:700;">Different return passenger</p>
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                                            <tr><td style="{{ $labelStyle }}">Last name</td><td style="{{ $valueStyle }}">{{ $passenger['return_replacement']['last_name'] ?? '-' }}</td></tr>
                                            <tr><td style="{{ $labelStyle }}">First name</td><td style="{{ $valueStyle }}">{{ $passenger['return_replacement']['first_name'] ?? '-' }}</td></tr>
                                            <tr><td style="{{ $labelStyle }}">Date of birth</td><td style="{{ $valueStyle }}">{{ $formatPassengerDate($passenger['return_replacement']['date_of_birth'] ?? null) }}</td></tr>
                                            <tr><td style="{{ $labelStyle }}">Gender</td><td style="{{ $valueStyle }}">{{ $passenger['return_replacement']['sexe'] ?? '-' }}</td></tr>
                                            <tr><td style="{{ $labelStyle }}">Passport</td><td style="{{ $valueStyle }}">{{ $passenger['return_replacement']['passport_number'] ?? '-' }}</td></tr>
                                            <tr><td style="{{ $labelStyle }}">Passport availability date</td><td style="{{ $valueStyle }}">{{ $formatPassengerDate($passenger['return_replacement']['passport_availability_date'] ?? null) }}</td></tr>
                                        </table>
                                    @endif
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            @else
                <p style="margin:0;padding:14px 16px;{{ $muted }}">No passenger details were submitted.</p>
            @endif
        </div>

        <div style="{{ $sectionStyle }}">
            <h2 style="{{ $sectionTitleStyle }}">Vehicle</h2>
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                <tr><td style="{{ $labelStyle }}">Brand</td><td style="{{ $valueStyle }}">{{ $brand ?: '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Model</td><td style="{{ $valueStyle }}">{{ $model ?: '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Model year</td><td style="{{ $valueStyle }}">{{ $reservation->vehicle_year ?: '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Custom dimensions</td><td style="{{ $valueStyle }}">{{ $yesNo((bool) $reservation->vehicle_custom_dimensions) }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Length</td><td style="{{ $valueStyle }}">{{ $reservation->vehicle_custom_dimensions ? $reservation->vehicle_length : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Width</td><td style="{{ $valueStyle }}">{{ $reservation->vehicle_custom_dimensions ? $reservation->vehicle_width : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Height</td><td style="{{ $valueStyle }}">{{ $reservation->vehicle_custom_dimensions ? $reservation->vehicle_height : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Roof box</td><td style="{{ $valueStyle }}">{{ $yesNo((bool) $reservation->has_roof_box) }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Extra roof height</td><td style="{{ $valueStyle }}">{{ $reservation->has_roof_extra ? $reservation->roof_extra_height : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Extra back length</td><td style="{{ $valueStyle }}">{{ $reservation->has_back_extra ? $reservation->back_extra_length : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">License plate</td><td style="{{ $valueStyle }}">{{ $reservation->vehicle_license_number }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Owner</td><td style="{{ $valueStyle }}">{{ $reservation->vehicle_owner }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Height confirmation</td><td style="{{ $valueStyle }}">{{ $yesNo((bool) $reservation->height_acceptance) }}</td></tr>
            </table>
        </div>

        <div style="{{ $sectionStyle }}">
            <h2 style="{{ $sectionTitleStyle }}">Trailer</h2>
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                <tr><td style="{{ $labelStyle }}">Trailer reservation</td><td style="{{ $valueStyle }}">{{ $yesNo((bool) $reservation->has_trailer) }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Trip</td><td style="{{ $valueStyle }}">{{ $reservation->has_trailer ? ($trailerTrip ?: '-') : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Type</td><td style="{{ $valueStyle }}">{{ $reservation->has_trailer ? ($reservation->trailer_type ?: '-') : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Length</td><td style="{{ $valueStyle }}">{{ $reservation->has_trailer ? ($reservation->trailer_length ?: '-') : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Width</td><td style="{{ $valueStyle }}">{{ $reservation->has_trailer ? ($reservation->trailer_width ?: '-') : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Height</td><td style="{{ $valueStyle }}">{{ $reservation->has_trailer ? ($reservation->trailer_height ?: '-') : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">License plate</td><td style="{{ $valueStyle }}">{{ $reservation->has_trailer ? ($reservation->trailer_license_number ?: '-') : '-' }}</td></tr>
                <tr><td style="{{ $labelStyle }}">Owner</td><td style="{{ $valueStyle }}">{{ $reservation->has_trailer ? ($reservation->trailer_owner ?: '-') : '-' }}</td></tr>
            </table>
        </div>

        <p style="margin:20px 0 0;">
            You can edit this reservation at any time by clicking the button below:
            <a href="{{ route('backoffice.ctn-reservations.show', $reservation) }}" style="display:inline-block;padding:12px 16px;border-radius:6px;background:#0f766e;color:#ffffff;text-decoration:none;font-size:14px;font-weight:700;">Open in backoffice</a>
        </p>
        <p style="margin:20px 0 0;">
            This email was sent automatically by the ferry booking system. Please do not reply to this email.
        </p>
    </div>
</div>
