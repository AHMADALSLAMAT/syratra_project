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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('airline_id');
            $table->string('flight_name');
            $table->string('flight_sku');
            $table->string('flight_price');
            $table->string('flight_type');
            $table->string('flight_leave_date');
            $table->string('flight_leave_hours');
            $table->string('flight_arrive_date');
            $table->string('flight_arrive_hours');
            $table->boolean('flight_stops')->default(0);
            $table->string('flight_stops_country')->nullable();
            $table->string('flight_stops_airport')->nullable();
            $table->string('flight_stops_date')->nullable();
            $table->string('flight_stops_hours')->nullable();
            $table->text('flight_leave_country');
            $table->text('flight_leave_airport');
            $table->text('flight_arrive_country');
            $table->text('flight_arrive_airport');
            $table->text('flight_amenities_title');
            $table->text('flight_amenities_icon');
            $table->boolean('flight_status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
