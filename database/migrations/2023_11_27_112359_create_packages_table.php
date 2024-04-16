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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description_small');
            $table->text('description_full');
            $table->text('loca_country');
            $table->text('loca_city');
            $table->text('amenities_title');
            $table->text('amenities_icon');
            $table->text('itinerary_Day');
            $table->text('itinerary_title');
            $table->text('itinerary_desc');
            $table->text('amenities_icon');
            $table->text('map');
            $table->text('price');
            $table->text('image');
            $table->text('gallery');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
