<?php

namespace Tests\Feature;

use App\Jobs\SendTombolaWinnerEmail;
use App\Mail\TombolaWinner;
use App\Models\TombolaCampaign;
use App\Models\TombolaParticipation;
use App\Models\User;
use App\Services\TombolaService;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\TestCase;

class TombolaTest extends TestCase
{
    use RefreshDatabase;

    private function activate(): TombolaCampaign
    {
        $campaign = TombolaCampaign::query()->findOrFail(1);
        $campaign->update(['enabled' => true, 'starts_at' => now()->subHour(), 'ends_at' => now()->addDays(5)]);

        return $campaign;
    }

    private function payload(array $overrides = []): array
    {
        $device = (string) Str::uuid();

        return array_replace([
            'device_id' => $device,
            'token' => app(TombolaService::class)->token($device),
            'request_id' => (string) Str::uuid(),
            'first_name' => 'Ada', 'last_name' => 'Lovelace',
            'email' => Str::uuid().'@example.com',
            'phone' => '491'.random_int(100000000, 999999999),
            'locale' => 'fr',
        ], $overrides);
    }

    public function test_admin_routes_require_an_administrator_and_reset_confirmation(): void
    {
        $this->get('/backoffice/tombola')->assertRedirect('/login');
        $this->actingAs(User::factory()->create())->get('/backoffice/tombola')->assertForbidden();
        $this->patch('/backoffice/tombola', [])->assertForbidden();
        $this->post('/backoffice/tombola/reset', [])->assertForbidden();
        $this->actingAs(User::factory()->admin()->create())->get('/backoffice/tombola')->assertOk()->assertSee('Aucune participation');
        $this->post('/backoffice/tombola/reset')->assertSessionHasErrors('confirmation');
    }

    public function test_planning_validates_dates_and_converts_berlin_time(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $this->patch('/backoffice/tombola', ['enabled' => 1])->assertSessionHasErrors(['starts_at', 'ends_at']);
        $this->patch('/backoffice/tombola', ['enabled' => 1, 'starts_at' => '2027-07-01T12:00', 'ends_at' => '2027-07-01T11:00'])->assertSessionHasErrors('ends_at');
        $this->patch('/backoffice/tombola', ['enabled' => 1, 'starts_at' => '2027-07-01T12:00', 'ends_at' => '2027-07-02T12:00'])->assertSessionHasNoErrors();
        $this->assertSame('2027-07-01 10:00', TombolaCampaign::find(1)->starts_at->format('Y-m-d H:i'));
        $this->patch('/backoffice/tombola', ['enabled' => 1, 'starts_at' => '2027-01-01T12:00', 'ends_at' => '2027-01-02T12:00'])->assertSessionHasNoErrors();
        $this->assertSame('2027-01-01 11:00', TombolaCampaign::find(1)->starts_at->format('Y-m-d H:i'));
        $this->patch('/backoffice/tombola', ['enabled' => 1, 'starts_at' => '2027-03-28T02:30', 'ends_at' => '2027-03-29T12:00'])->assertSessionHasErrors('starts_at');
        $this->patch('/backoffice/tombola', ['enabled' => 1, 'starts_at' => '2027-10-31T02:30', 'ends_at' => '2027-10-31T04:00'])->assertSessionHasNoErrors();
        $this->assertSame('2027-10-31 01:30', TombolaCampaign::find(1)->starts_at->format('Y-m-d H:i'));
    }

    public function test_schedule_start_is_inclusive_and_end_exclusive(): void
    {
        $this->travelTo(CarbonImmutable::parse('2027-01-01 12:00:00', 'UTC'));
        $campaign = $this->activate();
        $campaign->update(['starts_at' => now()->addHour(), 'ends_at' => now()->addHours(2)]);
        $this->postJson('/api/tombola/spin', $this->payload())->assertStatus(409);
        $this->travel(1)->hours();
        $this->postJson('/api/tombola/spin', $this->payload())->assertOk();
        $this->travel(1)->hours();
        $this->postJson('/api/tombola/spin', $this->payload())->assertStatus(409);
        $this->assertSame(1, $campaign->fresh()->spin_count);
    }

    public function test_two_complete_cycles_and_winner_jobs_are_deterministic(): void
    {
        Queue::fake();
        $campaign = $this->activate();
        // Service calls avoid the endpoint's intentional anti-abuse throttle.
        for ($i = 1; $i <= 44; $i++) {
            $expected = match ($i % 22) {
                11 => 20, 0 => 30, default => 0
            };
            $this->assertSame($expected, app(TombolaService::class)->spin($this->payload())['result']);
        }
        $this->assertSame(44, $campaign->fresh()->spin_count);
        $this->assertDatabaseCount('tombola_participations', 44);
        Queue::assertPushed(SendTombolaWinnerEmail::class, 4);
    }

    public function test_invalid_input_and_tokens_do_not_consume_a_spin(): void
    {
        $this->activate();
        $this->postJson('/api/tombola/spin', $this->payload(['first_name' => '', 'last_name' => '', 'email' => 'bad', 'phone' => 'abc']))->assertUnprocessable()->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'phone']);
        $this->postJson('/api/tombola/spin', $this->payload(['token' => 'forged']))->assertForbidden();
        $payload = $this->payload();
        $this->travel(3)->hours();
        $this->postJson('/api/tombola/spin', $payload)->assertForbidden();
        $this->assertDatabaseCount('tombola_participations', 0);
    }

    public function test_device_email_and_normalized_phone_each_block_a_second_spin(): void
    {
        $this->activate();
        $original = $this->payload(['email' => 'Ada@Example.com', 'phone' => '+49 (123) 456-7890']);
        $this->postJson('/api/tombola/spin', $original)->assertOk();
        $this->postJson('/api/tombola/spin', $this->payload(['device_id' => $original['device_id'], 'token' => $original['token']]))->assertUnprocessable()->assertJsonValidationErrors('participation');
        $this->postJson('/api/tombola/spin', $this->payload(['email' => ' ADA@example.com ']))->assertUnprocessable()->assertJsonValidationErrors('participation');
        $this->postJson('/api/tombola/spin', $this->payload(['phone' => '0049 123 4567890']))->assertUnprocessable()->assertJsonValidationErrors('participation');
        $this->assertDatabaseCount('tombola_participations', 1);
        $this->travel(24)->hours();
        $this->postJson('/api/tombola/spin', $this->payload(['email' => 'ada@example.com']))->assertOk();
    }

    public function test_idempotency_recovery_and_result_privacy(): void
    {
        $campaign = $this->activate();
        $payload = $this->payload();
        $first = $this->postJson('/api/tombola/spin', $payload)->assertOk()->json();
        $campaign->update(['enabled' => false]);
        $this->postJson('/api/tombola/spin', $payload)->assertOk()->assertExactJson($first);
        $this->postJson('/api/tombola/result', $payload)->assertOk()->assertJsonPath('previous.result', 0)->assertJsonMissingPath('previous.email');
        $other = $this->payload(['request_id' => $payload['request_id']]);
        $this->postJson('/api/tombola/result', $other)->assertOk()->assertJsonPath('previous', null);
        $this->postJson('/api/tombola/spin', $other)->assertForbidden();
        $this->assertDatabaseCount('tombola_participations', 1);
    }

    public function test_reset_releases_cooldowns_without_changing_history_or_sequence(): void
    {
        $campaign = $this->activate();
        $payload = $this->payload();
        $this->postJson('/api/tombola/spin', $payload)->assertOk();
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin)->post('/backoffice/tombola/reset', ['confirmation' => 1])->assertRedirect();
        $this->assertSame(1, $campaign->fresh()->spin_count);
        $this->assertDatabaseHas('tombola_resets', ['user_id' => $admin->id, 'generation' => 1]);
        $this->postJson('/api/tombola/status', ['device_id' => $payload['device_id']])->assertJsonPath('eligible', true);
        $payload['request_id'] = (string) Str::uuid();
        $this->postJson('/api/tombola/spin', $payload)->assertOk();
        $this->assertDatabaseCount('tombola_participations', 2);
        $this->assertSame(2, $campaign->fresh()->spin_count);
    }

    public function test_winner_email_is_localized_and_failures_preserve_the_prize(): void
    {
        Mail::fake();
        $campaign = $this->activate();
        $campaign->update(['spin_count' => 10]);
        $this->postJson('/api/tombola/spin', $this->payload(['locale' => 'de']))->assertJsonPath('result', 20);
        $this->assertDatabaseCount('jobs', 1);
        $winner = TombolaParticipation::firstOrFail();
        $job = new SendTombolaWinnerEmail($winner->id);
        $job->handle();
        $job->handle();
        Mail::assertSent(TombolaWinner::class, 1);
        $this->assertSame('sent', $winner->fresh()->email_status);
        $this->assertStringContainsString('20 % Rabatt', (new TombolaWinner($winner))->render());
        $winner->refresh()->update(['email_sent_at' => null]);
        $job->failed(new \RuntimeException('SMTP unavailable'));
        $this->assertSame('failed', $winner->fresh()->email_status);
        $this->assertSame(20, $winner->fresh()->result);
    }

    public function test_popup_is_only_on_reservation_pages_in_all_languages_including_embed(): void
    {
        $this->get('/')->assertDontSee('data-tombola-dialog', false);
        foreach (['/reservation-ctn', '/reservation-ctn/fr', '/reservation-ctn/de', '/reservation-ctn?embed=1'] as $url) {
            $this->get($url)->assertOk()->assertSee('data-tombola-dialog', false);
        }
        $this->postJson('/api/tombola/status', ['device_id' => (string) Str::uuid()])->assertOk()->assertJsonPath('active', false)->assertHeader('Cache-Control', 'no-store, private');
    }

    public function test_email_transport_failure_is_retryable_and_does_not_change_the_winner(): void
    {
        $campaign = $this->activate();
        $campaign->update(['spin_count' => 10]);
        $this->postJson('/api/tombola/spin', $this->payload())->assertJsonPath('result', 20);
        $winner = TombolaParticipation::firstOrFail();
        Mail::shouldReceive('to')->once()->with($winner->email)->andReturnSelf();
        Mail::shouldReceive('send')->once()->andThrow(new \RuntimeException('SMTP unavailable'));
        try {
            (new SendTombolaWinnerEmail($winner->id))->handle();
            $this->fail('SMTP failure must be rethrown for the queue worker to retry.');
        } catch (\RuntimeException $exception) {
            $this->assertSame('SMTP unavailable', $exception->getMessage());
        }
        $this->assertSame('retrying', $winner->fresh()->email_status);
        $this->assertSame(20, $winner->fresh()->result);
        $this->assertSame(11, $campaign->fresh()->spin_count);
    }

    public function test_history_filters_results_and_dates_in_berlin_time(): void
    {
        $this->travelTo(CarbonImmutable::parse('2027-07-01 22:30:00', 'UTC'));
        $campaign = $this->activate();
        $campaign->update(['spin_count' => 10]);
        $this->postJson('/api/tombola/spin', $this->payload(['last_name' => 'UniqueWinner']))->assertOk();
        $this->actingAs(User::factory()->admin()->create());
        $this->get('/backoffice/tombola?search=UniqueWinner&result=20&date_from=2027-07-02&date_to=2027-07-02')
            ->assertOk()->assertSee('UniqueWinner')->assertDontSee('Aucune participation');
        $this->get('/backoffice/tombola?result=0')->assertOk()->assertSee('Aucune participation');
        $this->get('/backoffice/tombola?date_to=2027-07-01')->assertOk()->assertSee('Aucune participation');
    }

    public function test_winner_email_supports_all_three_languages(): void
    {
        $campaign = $this->activate();
        $campaign->update(['spin_count' => 10]);
        $this->postJson('/api/tombola/spin', $this->payload())->assertOk();
        $winner = TombolaParticipation::firstOrFail();
        foreach (['fr' => '20 % de réduction', 'en' => '20% discount', 'de' => '20 % Rabatt'] as $locale => $text) {
            $winner->locale = $locale;
            $this->assertStringContainsString($text, (new TombolaWinner($winner))->render());
        }
    }

    public function test_status_requests_do_not_consume_the_spin_rate_limit(): void
    {
        $this->activate();
        $payload = $this->payload();
        for ($i = 0; $i < 12; $i++) {
            $this->postJson('/api/tombola/status', ['device_id' => $payload['device_id']])->assertOk();
        }
        for ($i = 0; $i < 10; $i++) {
            $this->postJson('/api/tombola/spin', $payload)->assertOk();
        }
        $this->postJson('/api/tombola/spin', $payload)->assertStatus(429);
        $this->postJson('/api/tombola/result', $payload)->assertOk()->assertJsonPath('previous.result', 0);
    }
}
