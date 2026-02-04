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
        Schema::create('eventopremio', function (Blueprint $table) {
            $table->integer('IDEventoPremio')->autoIncrement();
            $table->integer('IDEvento')->nullable();
            $table->integer('IDPremio')->nullable();
            $table->integer('Cantidad')->nullable();
            $table->integer('PosicionGanador')->nullable();
            $table->timestamps();

            $table->foreign('IDEvento')->references('IDEvento')->on('eventos');
            $table->foreign('IDPremio')->references('IDPremio')->on('premios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventopremio');
    }
};
