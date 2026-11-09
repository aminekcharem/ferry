<?php

namespace App\Http\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateTombolaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() === true;
    }

    public function rules(): array
    {
        return [
            'enabled' => ['required', 'boolean'],
            'starts_at' => ['nullable', 'required_if:enabled,1', 'date_format:Y-m-d\TH:i'],
            'ends_at' => ['nullable', 'required_if:enabled,1', 'date_format:Y-m-d\TH:i', 'after:starts_at'],
        ];
    }

    public function after(): array
    {
        return [function (Validator $validator): void {
            foreach (['starts_at', 'ends_at'] as $field) {
                if (! $this->filled($field) || $validator->errors()->has($field)) {
                    continue;
                }
                $value = $this->input($field);
                $date = CarbonImmutable::createFromFormat('!Y-m-d\TH:i', $value, 'Europe/Berlin');
                // Reject the missing hour during the spring DST transition.
                if ($date->format('Y-m-d\TH:i') !== $value) {
                    $validator->errors()->add($field, 'Cette heure n’existe pas dans le fuseau Europe/Berlin.');
                }
            }
        }];
    }

    public function campaignData(): array
    {
        return [
            'enabled' => $this->boolean('enabled'),
            'starts_at' => $this->filled('starts_at') ? CarbonImmutable::createFromFormat('!Y-m-d\TH:i', $this->input('starts_at'), 'Europe/Berlin')->utc() : null,
            'ends_at' => $this->filled('ends_at') ? CarbonImmutable::createFromFormat('!Y-m-d\TH:i', $this->input('ends_at'), 'Europe/Berlin')->utc() : null,
        ];
    }
}
