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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name');
            $table->string('slug');
            $table->text('hotel_description_small');
            $table->text('hotel_description_full');
            $table->text('loca_country');
            $table->text('loca_city');
            $table->text('hotel_amenities_title');
            $table->text('hotel_amenities_icon');
            $table->text('hotel_map');
            $table->text('hotel_rooms');
            $table->text('hotel_image');
            $table->text('hotel_gallery');
            $table->boolean('hotel_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
