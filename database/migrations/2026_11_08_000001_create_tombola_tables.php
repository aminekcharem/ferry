<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tombola_campaigns', function (Blueprint $table): void {
            $table->id();
            $table->boolean('enabled')->default(false);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->unsignedBigInteger('spin_count')->default(0);
            $table->unsignedBigInteger('generation')->default(0);
            $table->timestamps();
        });
        DB::table('tombola_campaigns')->insert(['id' => 1, 'created_at' => now(), 'updated_at' => now()]);

        Schema::create('tombola_participations', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tombola_campaign_id')->constrained();
            $table->unsignedBigInteger('generation');
            $table->uuid('device_id');
            $table->uuid('request_id')->unique();
            $table->string('last_name', 100);
            $table->string('first_name', 100);
            $table->string('email');
            $table->string('phone', 40);
            $table->string('locale', 2);
            $table->unsignedTinyInteger('result');
            $table->unsignedBigInteger('sequence')->unique();
            $table->string('email_status')->default('not_required');
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamps();
            $table->index(['generation', 'device_id', 'created_at']);
            $table->index(['generation', 'email', 'created_at']);
            $table->index(['generation', 'phone', 'created_at']);
            $table->index(['result', 'created_at']);
        });
        Schema::create('tombola_resets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tombola_campaign_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('generation');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tombola_resets');
        Schema::dropIfExists('tombola_participations');
        Schema::dropIfExists('tombola_campaigns');
    }
};
