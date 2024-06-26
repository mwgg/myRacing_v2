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
        Schema::create('series_schedule_car', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('season_id')->nullable();
            $table->integer('race_week_num')->nullable();
            $table->integer('car_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series_schedule_car');
    }
};
