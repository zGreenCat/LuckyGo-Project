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
        Schema::create('lottery_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticketID');
            $table->string('selectedNumbers')->default(false);
            $table->integer('price');
            $table->boolean('luck');
            $table->timestamp('date');
            $table->unsignedBigInteger('rafflesid');
            $table->timestamps();

            $table->foreign('rafflesid')->references('id')->on('raffles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_tickets');
    }
};