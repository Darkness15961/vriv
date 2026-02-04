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
        Schema::create('envios', function (Blueprint $table) {
            $table->integer('IDEnvio')->autoIncrement();
            $table->integer('IDParticipacion')->nullable();
            $table->integer('IDEventoPremio')->nullable();
            $table->string('Empresa', 150)->nullable();
            $table->string('CodigoRastreo', 100)->nullable();
            $table->string('Estado', 50)->nullable();
            $table->dateTime('FechaEnvio')->nullable();
            $table->dateTime('FechaEntrega')->nullable();
            $table->timestamps();

            $table->foreign('IDParticipacion')->references('IDParticipacion')->on('participacion');
            $table->foreign('IDEventoPremio')->references('IDEventoPremio')->on('eventopremio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
