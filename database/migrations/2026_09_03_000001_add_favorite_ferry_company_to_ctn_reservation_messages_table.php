<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ctn_reservation_messages', function (Blueprint $table): void {
            $table->string('favorite_ferry_company', 20)->nullable()->after('journey_type');
        });
    }

    public function down(): void
    {
        Schema::table('ctn_reservation_messages', function (Blueprint $table): void {
            $table->dropColumn('favorite_ferry_company');
        });
    }
};
