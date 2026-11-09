<?php

// Run explicitly with: php tests/Integration/tombola-concurrency.php
// Uses a newly created disposable MySQL database, never the application tables.
use App\Models\TombolaCampaign;
use App\Models\TombolaParticipation;
use App\Services\TombolaService;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

require __DIR__.'/../../vendor/autoload.php';
$app = require __DIR__.'/../../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();
$originalConnection = config('database.default');
$base = config('database.connections.'.$originalConnection);
if ($base['driver'] !== 'mysql') {
    fwrite(STDERR, "This integration check requires a MySQL default connection.\n");
    exit(1);
}
$worker = ($argv[1] ?? '') === 'worker';
$database = $worker ? ($argv[2] ?? '') : 'tombola_test_'.bin2hex(random_bytes(8));
if (! preg_match('/^tombola_test_[a-f0-9]{16}$/D', $database)) {
    throw new RuntimeException('Invalid disposable database name.');
}
config(['database.connections.tombola_test' => array_replace($base, ['database' => $database, 'url' => null]), 'queue.connections.database.connection' => 'tombola_test']);
if (! $worker) {
    DB::statement('CREATE DATABASE `'.$database.'` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
}
config(['database.default' => 'tombola_test']);

if ($worker) {
    $payload = json_decode(base64_decode($argv[3]), true, flags: JSON_THROW_ON_ERROR);
    $payload['token'] = app(TombolaService::class)->token($payload['device_id']);
    $start = (float) $argv[4];
    while (microtime(true) < $start) {
        usleep(1000);
    }
    try {
        echo json_encode(['status' => 200, ...app(TombolaService::class)->spin($payload)]);
    } catch (ValidationException $exception) {
        echo json_encode(['status' => 422]);
    }
    exit;
}

function payload(): array
{
    return ['device_id' => (string) Str::uuid(), 'request_id' => (string) Str::uuid(), 'first_name' => 'Test', 'last_name' => 'Concurrency', 'email' => Str::uuid().'@example.com', 'phone' => '491'.random_int(100000000, 999999999), 'locale' => 'en'];
}

function race(string $database, array $payloads): array
{
    $processes = [];
    $start = microtime(true) + 2;
    foreach ($payloads as $payload) {
        $process = proc_open([PHP_BINARY, __FILE__, 'worker', $database, base64_encode(json_encode($payload)), (string) $start], [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes, dirname(__DIR__, 2));
        if (! is_resource($process)) {
            throw new RuntimeException('Could not start concurrency worker.');
        }
        fclose($pipes[0]);
        $processes[] = [$process, $pipes];
    }
    $results = [];
    foreach ($processes as [$process, $pipes]) {
        $output = stream_get_contents($pipes[1]);
        $error = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        if (proc_close($process) !== 0) {
            throw new RuntimeException('Worker failed: '.$error);
        }
        $results[] = json_decode($output, true, flags: JSON_THROW_ON_ERROR);
    }

    return $results;
}

function check(bool $condition, string $message): void
{
    if (! $condition) {
        throw new RuntimeException($message);
    }
}

try {
    check(Artisan::call('migrate', ['--database' => 'tombola_test', '--force' => true]) === 0, 'Disposable database migrations failed.');
    $campaign = TombolaCampaign::findOrFail(1);
    $campaign->update(['enabled' => true, 'starts_at' => now()->subHour(), 'ends_at' => now()->addHour(), 'spin_count' => 9]);
    $results = race($database, array_map(fn () => payload(), range(1, 6)));
    check(count(array_filter($results, fn ($result) => ($result['result'] ?? null) === 20)) === 1, '20% prize was not allocated exactly once.');
    check($campaign->fresh()->spin_count === 15, 'Sequence was corrupted by concurrent requests.');

    foreach (['device_id', 'email', 'phone'] as $identity) {
        $shared = payload();
        $results = race($database, array_map(fn () => array_replace(payload(), [$identity => $shared[$identity]]), range(1, 4)));
        check(count(array_filter($results, fn ($result) => $result['status'] === 200)) === 1, 'Concurrent '.$identity.' entries bypassed the cooldown.');
    }

    $shared = payload();
    $before = TombolaParticipation::count();
    $results = race($database, array_fill(0, 4, $shared));
    check(count(array_filter($results, fn ($result) => $result['status'] === 200)) === 4, 'Idempotent retries did not all recover their result.');
    check(TombolaParticipation::count() === $before + 1, 'Idempotent retries inserted duplicate entries.');

    $campaign->update(['spin_count' => 21]);
    $results = race($database, array_map(fn () => payload(), range(1, 4)));
    check(count(array_filter($results, fn ($result) => ($result['result'] ?? null) === 30)) === 1, '30% prize was not allocated exactly once.');
    check(DB::table('jobs')->count() === 2, 'Winner jobs were not committed with their entries.');
    echo "PASS: concurrent prizes, device/email/phone cooldowns, idempotency and atomic winner jobs (MySQL).\n";
} finally {
    DB::disconnect('tombola_test');
    // Only the random, validated database created above can be removed here.
    config(['database.default' => $originalConnection]);
    DB::connection($originalConnection)->statement('DROP DATABASE `'.$database.'`');
}
