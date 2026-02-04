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
        Schema::create('premios', function (Blueprint $table) {
            $table->integer('IDPremio')->autoIncrement();
            $table->string('Nombre', 150)->nullable();
            $table->string('Descripcion', 255)->nullable();
            $table->string('Imagen_URL', 255)->nullable();
            $table->integer('Stock')->nullable();
            $table->decimal('ValorReferencial', 10, 2)->nullable();
            $table->string('Proveedor', 150)->nullable();
            $table->boolean('EsEnvio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premios');
    }
};
