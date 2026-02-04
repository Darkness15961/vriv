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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->integer('IDTransaccion')->autoIncrement();
            $table->unsignedBigInteger('IDUsuario')->nullable(); // User FK
            $table->decimal('Monto', 10, 2)->nullable();
            $table->string('Moneda', 10)->nullable();
            $table->integer('IDReferenciaOrigen')->nullable();
            $table->string('TipoTransaccion', 50)->nullable();
            $table->string('MetodoPago', 50)->nullable();
            $table->string('Estado', 50)->nullable();
            $table->dateTime('FechaTransaccion')->nullable();
            $table->timestamps();

            $table->foreign('IDUsuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
