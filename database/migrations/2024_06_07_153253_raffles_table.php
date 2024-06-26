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
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->date('sunday');
            $table->integer('stat');
            $table->integer('cant_tickets');
            $table->integer('cant_tickets_luck');
            $table->string('won')->nullable();
            $table->string('won_luck')->nullable();
            $table->string('usersEmail')->nullable();
            $table->Date('timeRegister')->nullable();
            $table->timestamps();
            $table->foreign('usersEmail')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};
