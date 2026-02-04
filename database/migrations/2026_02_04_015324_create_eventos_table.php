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
        Schema::create('eventos', function (Blueprint $table) {
            $table->integer('IDEvento')->autoIncrement();
            $table->string('Nombre', 150)->nullable();
            $table->string('Descripcion', 255)->nullable();
            $table->unsignedBigInteger('IDCreador')->nullable(); // Users FK
            $table->integer('PuntosMinimos')->nullable();
            $table->integer('IDPlanMinimo')->nullable();
            $table->integer('IDTipoEvento')->nullable();
            $table->dateTime('FechaInicio')->nullable();
            $table->dateTime('FechaFin')->nullable();
            $table->string('Estado', 50)->nullable();
            $table->text('ReglasBases')->nullable();
            $table->timestamps();

            $table->foreign('IDCreador')->references('id')->on('users');
            $table->foreign('IDPlanMinimo')->references('IDPlan')->on('planessuscripciones');
            $table->foreign('IDTipoEvento')->references('IDTipo')->on('tipoeventos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
