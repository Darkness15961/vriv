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
        Schema::create('participacion', function (Blueprint $table) {
            $table->integer('IDParticipacion')->autoIncrement();
            $table->unsignedBigInteger('IDUsuario')->nullable();
            $table->integer('IDEvento')->nullable();
            $table->dateTime('FechaParticipacion')->nullable();
            $table->boolean('EsGanador')->nullable();
            $table->integer('PuntajeEvento')->nullable();
            $table->integer('TiempoLogrado')->nullable();
            $table->timestamps();

            $table->foreign('IDUsuario')->references('id')->on('users');
            $table->foreign('IDEvento')->references('IDEvento')->on('eventos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participacion');
    }
};
