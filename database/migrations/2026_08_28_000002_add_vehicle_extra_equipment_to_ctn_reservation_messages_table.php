<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ctn_reservation_messages', function (Blueprint $table): void {
            $table->boolean('has_roof_box')->default(false)->after('vehicle_height');
            $table->boolean('has_roof_extra')->default(false)->after('has_roof_box');
            $table->decimal('roof_extra_height', 8, 2)->nullable()->after('has_roof_extra');
            $table->boolean('has_back_extra')->default(false)->after('roof_extra_height');
            $table->decimal('back_extra_length', 8, 2)->nullable()->after('has_back_extra');
        });
    }

    public function down(): void
    {
        Schema::table('ctn_reservation_messages', function (Blueprint $table): void {
            $table->dropColumn([
                'has_roof_box',
                'has_roof_extra',
                'roof_extra_height',
                'has_back_extra',
                'back_extra_length',
            ]);
        });
    }
};
