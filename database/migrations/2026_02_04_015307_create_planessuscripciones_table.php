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
        Schema::create('planessuscripciones', function (Blueprint $table) {
            $table->integer('IDPlan')->autoIncrement();
            $table->unsignedBigInteger('IDCreador')->nullable(); // Users id is usually unsignedBigInteger
            $table->string('Nombre', 150)->nullable();
            $table->string('Descripcion', 255)->nullable();
            $table->decimal('Precio', 10, 2)->nullable();
            $table->string('Periodicidad', 50)->nullable();
            $table->timestamps();

            $table->foreign('IDCreador')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planessuscripciones');
    }
};
