<?php

return [
    'booking_notification_emails' => env(
        'FERRY_BOOKING_NOTIFICATION_EMAILS',
        env('FERRY_BOOKING_NOTIFICATION_EMAIL', 'amine.kcharem@gmail.com')
    ),
];
