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
        Schema::create('logros', function (Blueprint $table) {
            $table->integer('id_Logro')->autoIncrement();
            $table->string('Nombre', 150)->nullable();
            $table->string('Descripcion', 255)->nullable();
            $table->string('ImagenURL', 255)->nullable();
            $table->integer('PuntosOtorgados')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logros');
    }
};
