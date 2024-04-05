<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('series_schedules', function (Blueprint $table) {
            $table->tinyInteger('precip_chance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('series_schedules', function (Blueprint $table) {
            $table->dropColumn('precip_chance');
        });
    }
};
