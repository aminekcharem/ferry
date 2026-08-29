<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CtnReservationMessage extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_RESERVED = 'reserved';
    public const STATUS_CANCELLED = 'cancelled';

    public const STATUSES = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_RESERVED => 'Booked',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_message',
        'journey_type',
        'departure_country',
        'return_country',
        'outward_date',
        'return_date',
        'outward_passengers',
        'return_passengers',
        'passenger_details',
        'vehicle_brand',
        'vehicle_brand_other',
        'vehicle_model',
        'vehicle_model_other',
        'vehicle_year',
        'vehicle_custom_dimensions',
        'vehicle_length',
        'vehicle_width',
        'vehicle_height',
        'has_roof_box',
        'has_roof_extra',
        'roof_extra_height',
        'has_back_extra',
        'back_extra_length',
        'vehicle_license_number',
        'vehicle_owner',
        'has_trailer',
        'trailer_outward',
        'trailer_return',
        'trailer_type',
        'trailer_length',
        'trailer_width',
        'trailer_height',
        'trailer_license_number',
        'trailer_owner',
        'height_acceptance',
        'submitted_ip',
        'user_agent',
        'viewed_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'outward_date' => 'date',
            'return_date' => 'date',
            'outward_passengers' => 'array',
            'return_passengers' => 'array',
            'passenger_details' => 'array',
            'vehicle_custom_dimensions' => 'boolean',
            'has_roof_box' => 'boolean',
            'has_roof_extra' => 'boolean',
            'has_back_extra' => 'boolean',
            'vehicle_year' => 'integer',
            'has_trailer' => 'boolean',
            'trailer_outward' => 'boolean',
            'trailer_return' => 'boolean',
            'height_acceptance' => 'boolean',
            'viewed_at' => 'datetime',
        ];
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('viewed_at');
    }

    public function statusNotes(): HasMany
    {
        return $this->hasMany(CtnReservationStatusNote::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? self::STATUSES[self::STATUS_PENDING];
    }

    public function displayReturnCountry(): ?string
    {
        if ($this->journey_type !== 'round_trip') {
            return null;
        }

        if (filled($this->return_country)) {
            return $this->return_country;
        }

        $parts = array_map('trim', explode(' - ', (string) $this->departure_country, 2));

        if (count($parts) !== 2 || $parts[0] === '' || $parts[1] === '') {
            return null;
        }

        return "{$parts[1]} - {$parts[0]}";
    }
}
