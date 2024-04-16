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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_ref');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('flight_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->string('user_fname');
            $table->string('user_lname');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('amount')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
