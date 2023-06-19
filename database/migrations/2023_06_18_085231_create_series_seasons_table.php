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
        Schema::create('series_seasons', function (Blueprint $table) {
            $table->id();
            $table->boolean('fixed_setup');
            $table->boolean('is_heat_racing');
            $table->integer('license_group');
            $table->boolean('multiclass');
            $table->boolean('official');
            $table->string('schedule_description');
            $table->integer('season_id');
            $table->string('season_short_name');
            $table->integer('season_year');
            $table->integer('season_quarter');
            $table->integer('series_id');
            $table->timestamp('start_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series_seasons');
    }
};
