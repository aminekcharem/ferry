<?php

namespace App\Services;

use App\Jobs\SendTombolaWinnerEmail;
use App\Models\TombolaCampaign;
use App\Models\TombolaParticipation;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TombolaService
{
    public function campaign(): TombolaCampaign
    {
        return TombolaCampaign::query()->findOrFail(1);
    }

    public function token(string $device): string
    {
        return Crypt::encryptString(json_encode(['device' => $device, 'expires' => now()->addHours(2)->timestamp], JSON_THROW_ON_ERROR));
    }

    public function verifyToken(string $token, string $device): void
    {
        try {
            $payload = json_decode(Crypt::decryptString($token), true, 512, JSON_THROW_ON_ERROR);
        } catch (DecryptException|\JsonException $exception) {
            abort(403, 'Invalid tombola token.');
        }
        abort_unless(is_array($payload) && ($payload['device'] ?? null) === $device && ($payload['expires'] ?? 0) > now()->timestamp, 403, 'Expired tombola token.');
    }

    public function latest(TombolaCampaign $campaign, string $device, ?string $email = null, ?string $phone = null): ?TombolaParticipation
    {
        return $campaign->participations()
            ->where('generation', $campaign->generation)
            ->where('created_at', '>', now()->subHours(24))
            ->where(function ($query) use ($device, $email, $phone): void {
                $query->where('device_id', $device);
                if ($email !== null) {
                    $query->orWhere('email', $email);
                }
                if ($phone !== null) {
                    $query->orWhere('phone', $phone);
                }
            })->latest('created_at')->first();
    }

    public function result(TombolaParticipation $participation): array
    {
        return [
            'result' => $participation->result,
            'next_allowed_at' => $participation->created_at->copy()->addHours(24)->toIso8601String(),
        ];
    }

    public function status(string $device): array
    {
        $campaign = $this->campaign();
        $latest = $this->latest($campaign, $device);

        return [
            'active' => $campaign->state() === 'active',
            'eligible' => $latest === null,
            'generation' => $campaign->generation,
            'token' => $this->token($device),
            'previous' => $latest ? $this->result($latest) : null,
        ];
    }

    public function spin(array $data): array
    {
        $this->verifyToken($data['token'], $data['device_id']);

        return DB::transaction(function () use ($data): array {
            // This single lock serializes both the prize sequence and all eligibility checks.
            $campaign = TombolaCampaign::query()->lockForUpdate()->findOrFail(1);
            $existing = $campaign->participations()->where('request_id', $data['request_id'])->first();
            if ($existing) {
                abort_unless(hash_equals($existing->device_id, $data['device_id']), 403);

                return $this->result($existing);
            }
            abort_unless($campaign->state() === 'active', 409, 'Campaign is not active.');
            $latest = $this->latest($campaign, $data['device_id'], $data['email'], $data['phone']);
            if ($latest) {
                throw ValidationException::withMessages([
                    'participation' => ['24h: '.$latest->created_at->copy()->addHours(24)->toIso8601String()],
                ]);
            }
            $sequence = $campaign->spin_count + 1;
            $result = match ($sequence % 22) {
                11 => 20, 0 => 30, default => 0
            };
            $participation = $campaign->participations()->create([
                'generation' => $campaign->generation,
                'device_id' => $data['device_id'],
                'request_id' => $data['request_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'locale' => $data['locale'],
                'sequence' => $sequence,
                'result' => $result,
                'email_status' => $result ? 'pending' : 'not_required',
            ]);
            $campaign->update(['spin_count' => $sequence]);
            if ($result) {
                // Queue inside the same database transaction: a committed winner always has a job.
                SendTombolaWinnerEmail::dispatch($participation->id)->onConnection('database')->beforeCommit();
            }

            return $this->result($participation);
        }, 5);
    }

    public function recover(string $device, string $token, string $requestId): ?array
    {
        $this->verifyToken($token, $device);
        $participation = TombolaParticipation::query()->where('device_id', $device)->where('request_id', $requestId)->first();

        return $participation ? $this->result($participation) : null;
    }

    public function update(array $data): void
    {
        DB::transaction(function () use ($data): void {
            TombolaCampaign::query()->lockForUpdate()->findOrFail(1)->update($data);
        });
    }

    public function reset(User $user): void
    {
        DB::transaction(function () use ($user): void {
            $campaign = TombolaCampaign::query()->lockForUpdate()->findOrFail(1);
            $campaign->increment('generation');
            $campaign->resets()->create(['user_id' => $user->id, 'generation' => $campaign->generation]);
        });
    }

    public function history(array $filters): array
    {
        $campaign = $this->campaign();
        $query = $campaign->participations()
            ->when($filters['search'] ?? null, function ($query, $search): void {
                $query->where(function ($query) use ($search): void {
                    foreach (['first_name', 'last_name', 'email', 'phone'] as $field) {
                        $query->orWhere($field, 'like', '%'.$search.'%');
                    }
                });
            })
            ->when(isset($filters['result']), fn ($query) => $query->where('result', $filters['result']))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', CarbonImmutable::parse($date, 'Europe/Berlin')->startOfDay()->utc()))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<', CarbonImmutable::parse($date, 'Europe/Berlin')->addDay()->startOfDay()->utc()));

        return [
            'campaign' => $campaign,
            'participations' => $query->latest('id')->paginate(20)->withQueryString(),
            'counts' => $campaign->participations()->selectRaw('COUNT(*) as total, COALESCE(SUM(CASE WHEN result = 20 THEN 1 ELSE 0 END), 0) as winners20, COALESCE(SUM(CASE WHEN result = 30 THEN 1 ELSE 0 END), 0) as winners30')->first(),
            'lastReset' => $campaign->resets()->with('user')->latest('id')->first(),
            'filters' => $filters,
        ];
    }
}
