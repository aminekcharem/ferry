<?php

namespace App\Http\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreCtnReservationMessageRequest extends FormRequest
{
    private const ACCEPTED_DATE_FORMATS = ['Y-m-d', 'd/m/Y'];

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
            'departure_country' => ['required', 'in:Tunisia - Gênes,Tunisia - Civitavecchia,Tunisia - Palerme (Sicile),Tunisia - Marseille,Gênes - Tunisia,Civitavecchia - Tunisia,Palerme - Tunisia,Marseille - Tunisia'],
            'outward_date' => ['required', 'string'],
            'return_date' => ['nullable', 'required_if:journey_type,round_trip', 'string'],
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
            $outwardDate = $this->dateFromInput($this->input('outward_date'));
            $returnDate = $this->dateFromInput($this->input('return_date'));

            if (! $validator->errors()->has('outward_date') && $outwardDate === null) {
                $validator->errors()->add('outward_date', 'The outward date must be a valid date.');
            }

            if ($this->filled('return_date') && ! $validator->errors()->has('return_date') && $returnDate === null) {
                $validator->errors()->add('return_date', 'The return date must be a valid date.');
            }

            if ($outwardDate !== null && $returnDate !== null && $returnDate->lt($outwardDate)) {
                $validator->errors()->add('return_date', 'The return date must be after or equal to the outward date.');
            }

            $this->validatePassportAvailabilityDates(
                $this->input('passenger_details', []),
                'passenger_details',
                $minimumPassportDate,
                $maximumPassportYear,
                $validator,
            );
        });
    }

    public function validatedForStorage(): array
    {
        $data = $this->validated();

        $data['outward_date'] = $this->dateFromInput($data['outward_date'])?->format('Y-m-d');
        $data['return_date'] = isset($data['return_date']) && $data['return_date'] !== ''
            ? $this->dateFromInput($data['return_date'])?->format('Y-m-d')
            : null;

        return $data;
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

            if ($key === 'date_of_birth' || $key === 'passport_availability_date') {
                $dateValue = (string) $nestedValue;
                $date = $this->dateFromInput($dateValue);

                if ($date === null) {
                    $validator->errors()->add($nestedAttribute, 'The ' . str_replace('_', ' ', $key) . ' must be a valid date.');

                    continue;
                }

                if ($key === 'date_of_birth' && $date->gt(CarbonImmutable::today())) {
                    $validator->errors()->add($nestedAttribute, 'The date of birth must be today or earlier.');
                }

                if ($key === 'date_of_birth') {
                    continue;
                }

                if ($date->lt($minimumDate)) {
                    $validator->errors()->add($nestedAttribute, 'The passport availability date must be after today.');
                }

                if ($date->year > $maximumYear) {
                    $validator->errors()->add($nestedAttribute, "The passport availability date year may not be after {$maximumYear}.");
                }

                continue;
            }

            $this->validatePassportAvailabilityDates($nestedValue, $nestedAttribute, $minimumDate, $maximumYear, $validator);
        }
    }

    private function dateFromInput(mixed $value): ?CarbonImmutable
    {
        if (! is_string($value) || trim($value) === '') {
            return null;
        }

        foreach (self::ACCEPTED_DATE_FORMATS as $format) {
            try {
                $date = CarbonImmutable::createFromFormat('!' . $format, trim($value));
            } catch (\InvalidArgumentException) {
                continue;
            }

            if ($date->format($format) === trim($value)) {
                return $date->startOfDay();
            }
        }

        return null;
    }
}
