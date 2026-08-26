<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ctn_reservation_messages', function (Blueprint $table): void {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 40);
            $table->text('customer_message')->nullable();
            $table->string('journey_type', 20);
            $table->string('departure_country', 80);
            $table->date('outward_date');
            $table->date('return_date')->nullable();
            $table->json('outward_passengers');
            $table->json('return_passengers')->nullable();
            $table->string('vehicle_brand', 100);
            $table->string('vehicle_brand_other', 100)->nullable();
            $table->string('vehicle_model', 100);
            $table->string('vehicle_model_other', 100)->nullable();
            $table->boolean('vehicle_custom_dimensions')->default(false);
            $table->decimal('vehicle_length', 8, 2)->nullable();
            $table->decimal('vehicle_width', 8, 2)->nullable();
            $table->decimal('vehicle_height', 8, 2)->nullable();
            $table->string('vehicle_license_number', 80);
            $table->string('vehicle_owner');
            $table->boolean('has_trailer')->default(false);
            $table->boolean('trailer_outward')->default(false);
            $table->boolean('trailer_return')->default(false);
            $table->string('trailer_type', 80)->nullable();
            $table->decimal('trailer_length', 8, 2)->nullable();
            $table->decimal('trailer_width', 8, 2)->nullable();
            $table->decimal('trailer_height', 8, 2)->nullable();
            $table->string('trailer_license_number', 80)->nullable();
            $table->string('trailer_owner')->nullable();
            $table->boolean('height_acceptance')->default(false);
            $table->string('submitted_ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index(['created_at', 'journey_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ctn_reservation_messages');
    }
};
