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
        Schema::table('series_schedule_car', function (Blueprint $table) {
            $table->dropColumn(['season_id', 'race_week_num', 'created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('series_schedule_car', function (Blueprint $table) {
            $table->bigInteger('season_id')->nullable();
            $table->integer('race_week_num')->nullable();
            $table->timestamps();
        });
    }
};
