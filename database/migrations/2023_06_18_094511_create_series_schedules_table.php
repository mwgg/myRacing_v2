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
        Schema::create('series_schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('unique_id');
            $table->integer('season_id');
            $table->integer('race_week_num');
            $table->integer('series_id');
            $table->timestamp('start_date');
            $table->integer('race_lap_limit')->nullable();
            $table->integer('race_time_limit')->nullable();
            $table->string('start_type');
            $table->string('restart_type');
            $table->boolean('qual_attached');
            $table->boolean('full_course_cautions');
            $table->boolean('start_zone');
            $table->integer('track_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series_schedules');
    }
};
