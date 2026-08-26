<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ctn_reservation_status_notes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('ctn_reservation_message_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('from_status', 20)->nullable();
            $table->string('to_status', 20);
            $table->text('note');
            $table->timestamps();

            $table->index(['ctn_reservation_message_id', 'created_at'], 'ctn_status_notes_reservation_created_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ctn_reservation_status_notes');
    }
};
