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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->integer('IDNotificacion')->autoIncrement();
            $table->unsignedBigInteger('IDUsuario');
            $table->integer('IDTipoNotificacion');
            $table->text('Mensaje')->nullable();
            $table->boolean('Leido')->default(false);
            $table->dateTime('FechaCreacion')->nullable();
            $table->timestamps();

            $table->foreign('IDUsuario')->references('id')->on('users');
            $table->foreign('IDTipoNotificacion')->references('IDTipoNotificacion')->on('tiponotificaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
