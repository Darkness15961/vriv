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
        Schema::create('logrousuarios', function (Blueprint $table) {
            $table->integer('ID_LogroUsuario')->autoIncrement();
            $table->unsignedBigInteger('IDUsuario')->nullable();
            $table->integer('IDLogro')->nullable();
            $table->dateTime('FechaObtencion')->nullable();
            $table->timestamps();

            $table->foreign('IDUsuario')->references('id')->on('users');
            $table->foreign('IDLogro')->references('id_Logro')->on('logros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logrousuarios');
    }
};
