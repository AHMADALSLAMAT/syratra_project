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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('cityName');
            $table->string('countryName');
            $table->string('countryCode');
            $table->string('timezone');
            $table->string('lat');
            $table->string('lon');
            $table->integer('numAirports');
            $table->enum('city',['true','fasle']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
