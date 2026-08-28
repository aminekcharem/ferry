<?php

namespace App\Http\Requests;

use App\Services\ApplicationSettingService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateBackofficeSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() === true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'booking_notification_emails' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $emails = app(ApplicationSettingService::class)
                    ->emailListFromString($this->input('booking_notification_emails'));

                foreach ($emails as $email) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                        $validator->errors()->add(
                            'booking_notification_emails',
                            'Enter valid email addresses separated with commas.'
                        );

                        return;
                    }
                }
            },
        ];
    }

    public function normalizedBookingNotificationEmails(): string
    {
        return app(ApplicationSettingService::class)->emailListToString(
            app(ApplicationSettingService::class)
                ->emailListFromString($this->input('booking_notification_emails'))
        );
    }
}
