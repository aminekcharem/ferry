<?php

namespace App\Jobs;

use App\Mail\TombolaWinner;
use App\Models\TombolaParticipation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendTombolaWinnerEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 60;

    public function __construct(public readonly int $participationId) {}

    public function backoff(): array
    {
        return [60, 300, 900];
    }

    public function handle(): void
    {
        $participation = TombolaParticipation::query()->findOrFail($this->participationId);
        if (! $participation->result || $participation->email_sent_at) {
            return;
        }
        try {
            Mail::to($participation->email)->send(new TombolaWinner($participation));
            $participation->update(['email_status' => 'sent', 'email_sent_at' => now()]);
        } catch (Throwable $exception) {
            $participation->update(['email_status' => 'retrying']);
            throw $exception;
        }
    }

    public function failed(?Throwable $exception): void
    {
        TombolaParticipation::query()->whereKey($this->participationId)->whereNull('email_sent_at')->update(['email_status' => 'failed']);
    }
}
