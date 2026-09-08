<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ctn_reservation_messages', function (Blueprint $table): void {
            $table->boolean('roof_extra_outward')->default(false)->after('roof_extra_height');
            $table->boolean('back_extra_outward')->default(false)->after('back_extra_length');
        });
    }

    public function down(): void
    {
        Schema::table('ctn_reservation_messages', function (Blueprint $table): void {
            $table->dropColumn([
                'roof_extra_outward',
                'back_extra_outward',
            ]);
        });
    }
};
