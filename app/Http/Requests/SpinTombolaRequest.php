<?php

namespace App\Http\Requests;

class SpinTombolaRequest extends TombolaDeviceRequest
{
    protected function prepareForValidation(): void
    {
        $normalized = [];
        foreach (['first_name', 'last_name', 'email', 'phone'] as $field) {
            if (is_string($this->input($field))) {
                $normalized[$field] = trim($this->input($field));
            }
        }
        if (isset($normalized['email'])) {
            $normalized['email'] = mb_strtolower($normalized['email']);
        }
        if (isset($normalized['phone'])) {
            $normalized['phone'] = preg_replace('/[\s().-]+/', '', $normalized['phone']);
            $normalized['phone'] = preg_replace('/^(?:\+|00)/', '', $normalized['phone']);
        }
        $this->merge($normalized);
    }

    public function rules(): array
    {
        return parent::rules() + [
            'token' => ['required', 'string', 'max:2048'],
            'request_id' => ['required', 'uuid'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{7,15}$/'],
            'locale' => ['required', 'in:fr,en,de'],
            'website' => ['prohibited'],
        ];
    }
}
