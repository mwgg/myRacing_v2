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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->boolean('free');
            $table->string('location');
            $table->integer('package_id');
            $table->integer('track_id');
            $table->double('price');
            $table->integer('sku');
            $table->string('name');
            $table->string('config_name')->nullable();
            $table->string('image_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('map_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
