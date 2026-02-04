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
        Schema::create('tiponotificaciones', function (Blueprint $table) {
            $table->integer('IDTipoNotificacion')->autoIncrement();
            $table->string('Nombre', 100);
            $table->string('Descripcion', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiponotificaciones');
    }
};
