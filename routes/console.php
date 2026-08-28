<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('user:make-admin {email}', function (string $email): int {
    $user = User::where('email', $email)->first();

    if (! $user) {
        $this->error("No user found with email [{$email}].");

        return self::FAILURE;
    }

    $user->forceFill(['is_admin' => true])->save();

    $this->info("User [{$user->email}] is now an administrator.");

    return self::SUCCESS;
})->purpose('Grant administrator access to an existing user');
