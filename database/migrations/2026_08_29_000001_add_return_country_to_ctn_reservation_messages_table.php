<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ctn_reservation_messages', function (Blueprint $table): void {
            $table->string('return_country', 80)->nullable()->after('departure_country');
        });
    }

    public function down(): void
    {
        Schema::table('ctn_reservation_messages', function (Blueprint $table): void {
            $table->dropColumn('return_country');
        });
    }
};
