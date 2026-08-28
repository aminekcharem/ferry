<?php

namespace App\Services;

use App\Models\ApplicationSetting;

class ApplicationSettingService
{
    public const BOOKING_NOTIFICATION_EMAILS = 'booking_notification_emails';

    public function get(string $key, ?string $default = null): ?string
    {
        return ApplicationSetting::query()
            ->where('key', $key)
            ->value('value') ?? $default;
    }

    public function set(string $key, ?string $value): void
    {
        ApplicationSetting::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        );
    }

    /**
     * @return list<string>
     */
    public function bookingNotificationEmails(): array
    {
        return $this->emailListFromString(
            $this->get(self::BOOKING_NOTIFICATION_EMAILS, config('ferry.booking_notification_emails', ''))
        );
    }

    /**
     * @return list<string>
     */
    public function emailListFromString(?string $emails): array
    {
        if ($emails === null) {
            return [];
        }

        return array_values(array_unique(array_filter(
            array_map(
                fn (string $email): string => mb_strtolower(trim($email)),
                explode(',', $emails)
            ),
            fn (string $email): bool => $email !== ''
        )));
    }

    public function emailListToString(array $emails): string
    {
        return implode(', ', $this->emailListFromString(implode(',', $emails)));
    }
}
