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
        Schema::create('hotelrooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->text('room_description');
            $table->text('room_amenities_title');
            $table->text('room_amenities_icon');
            $table->text('room_price');
            $table->text('room_beds');
            $table->text('room_lvl');
            $table->text('room_type');
            $table->text('num_of_rooms');
            $table->text('room_image');
            $table->text('room_gallery');
            $table->boolean('room_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotelrooms');
    }
};
