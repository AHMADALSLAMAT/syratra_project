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
        Schema::create('cardsinfos', function (Blueprint $table) {
            $table->id();
            $table->string('Cardname');
            $table->integer('Cardnumber');
            $table->integer('Expirymonth');
            $table->integer('Expiryyear');
            $table->integer('ccvnumber');
            $table->integer('amount')->default(0);
            $table->boolean('termsCheckbox')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardsinfos');
    }
};
