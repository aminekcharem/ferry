<?php

namespace App\Http\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreCtnReservationMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:40'],
            'customer_message' => ['nullable', 'string', 'max:5000'],
            'journey_type' => ['required', 'in:one_way,round_trip'],
            'departure_country' => ['required', 'in:Italy,France,Tunisia'],
            'outward_date' => ['required', 'date'],
            'return_date' => ['nullable', 'required_if:journey_type,round_trip', 'date', 'after_or_equal:outward_date'],
            'outward_passengers' => ['required', 'array', 'size:6'],
            'outward_passengers.*' => ['required', 'integer', 'min:0', 'max:99'],
            'return_passengers' => ['nullable', 'array', 'size:6'],
            'return_passengers.*' => ['required', 'integer', 'min:0', 'max:99'],
            'passenger_details' => ['nullable', 'array'],
            'passenger_details.*' => ['array'],
            'vehicle_brand' => ['required', 'string', 'max:100'],
            'vehicle_brand_other' => ['nullable', 'required_if:vehicle_brand,Other', 'string', 'max:100'],
            'vehicle_model' => ['required', 'string', 'max:100'],
            'vehicle_model_other' => ['nullable', 'required_if:vehicle_model,Other', 'string', 'max:100'],
            'vehicle_year' => ['nullable', 'integer', 'min:1960', 'max:' . (now()->addYear()->year)],
            'vehicle_custom_dimensions' => ['nullable', 'boolean'],
            'vehicle_length' => ['nullable', 'required_if:vehicle_custom_dimensions,1', 'numeric', 'min:0', 'max:999999.99'],
            'vehicle_width' => ['nullable', 'required_if:vehicle_custom_dimensions,1', 'numeric', 'min:0', 'max:999999.99'],
            'vehicle_height' => ['nullable', 'required_if:vehicle_custom_dimensions,1', 'numeric', 'min:0', 'max:999999.99'],
            'vehicle_license_number' => ['required', 'string', 'max:80'],
            'vehicle_owner' => ['required', 'string', 'max:255'],
            'has_trailer' => ['nullable', 'boolean'],
            'trailer_outward' => ['nullable', 'boolean'],
            'trailer_return' => ['nullable', 'boolean'],
            'trailer_type' => ['nullable', 'required_if:has_trailer,1', 'string', 'max:80'],
            'trailer_length' => ['nullable', 'required_if:has_trailer,1', 'numeric', 'min:0', 'max:999999.99'],
            'trailer_width' => ['nullable', 'required_if:has_trailer,1', 'numeric', 'min:0', 'max:999999.99'],
            'trailer_height' => ['nullable', 'required_if:has_trailer,1', 'numeric', 'min:0', 'max:999999.99'],
            'trailer_license_number' => ['nullable', 'string', 'max:80'],
            'trailer_owner' => ['nullable', 'string', 'max:255'],
            'height_acceptance' => ['accepted'],
        ];
    }
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $minimumPassportDate = CarbonImmutable::today()->addDay();
            $maximumPassportYear = CarbonImmutable::today()->addYears(10)->year;

            $this->validatePassportAvailabilityDates(
                $this->input('passenger_details', []),
                'passenger_details',
                $minimumPassportDate,
                $maximumPassportYear,
                $validator,
            );
        });
    }

    private function validatePassportAvailabilityDates(
        mixed $value,
        string $attribute,
        CarbonImmutable $minimumDate,
        int $maximumYear,
        Validator $validator
    ): void {
        if (! is_array($value)) {
            return;
        }

        foreach ($value as $key => $nestedValue) {
            $nestedAttribute = "{$attribute}.{$key}";

            if ($key === 'passport_availability_date') {
                $dateValue = (string) $nestedValue;

                if (! CarbonImmutable::canBeCreatedFromFormat($dateValue, 'Y-m-d')) {
                    $validator->errors()->add($nestedAttribute, 'The passport availability date must be a valid date.');

                    continue;
                }

                $passportDate = CarbonImmutable::createFromFormat('Y-m-d', $dateValue)->startOfDay();

                if ($passportDate->lt($minimumDate)) {
                    $validator->errors()->add($nestedAttribute, 'The passport availability date must be after today.');
                }

                if ($passportDate->year > $maximumYear) {
                    $validator->errors()->add($nestedAttribute, "The passport availability date year may not be after {$maximumYear}.");
                }

                continue;
            }

            $this->validatePassportAvailabilityDates($nestedValue, $nestedAttribute, $minimumDate, $maximumYear, $validator);
        }
    }
}
