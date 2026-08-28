@php
    $brand = $reservation->vehicle_brand === 'Other' ? $reservation->vehicle_brand_other : $reservation->vehicle_brand;
    $model = $reservation->vehicle_model === 'Other' ? $reservation->vehicle_model_other : $reservation->vehicle_model;
@endphp

<h1>New ferry reservation request</h1>

<p>A new reservation request has been submitted from the website.</p>

<h2>Customer</h2>
<p>
    <strong>Name:</strong> {{ $reservation->customer_name }}<br>
    <strong>Email:</strong> {{ $reservation->customer_email }}<br>
    <strong>Phone:</strong> {{ $reservation->customer_phone }}
</p>

<h2>Trip</h2>
<p>
    <strong>Type:</strong> {{ $reservation->journey_type === 'round_trip' ? 'Round trip' : 'One way' }}<br>
    <strong>Departure:</strong> {{ $reservation->departure_country }}<br>
    <strong>Outward date:</strong> {{ $reservation->outward_date?->format('d/m/Y') }}<br>
    <strong>Return date:</strong> {{ $reservation->return_date?->format('d/m/Y') ?? '-' }}
</p>

<h2>Vehicle</h2>
<p>
    <strong>Brand / model:</strong> {{ trim($brand.' '.$model) ?: '-' }}{{ $reservation->vehicle_year ? ' ('.$reservation->vehicle_year.')' : '' }}<br>
    <strong>License plate:</strong> {{ $reservation->vehicle_license_number }}<br>
    <strong>Owner:</strong> {{ $reservation->vehicle_owner }}
</p>

@if ($reservation->customer_message)
    <h2>Message</h2>
    <p>{{ $reservation->customer_message }}</p>
@endif

<p>
    <a href="{{ route('backoffice.ctn-reservations.show', $reservation) }}">Open this reservation in the backoffice</a>
</p>
