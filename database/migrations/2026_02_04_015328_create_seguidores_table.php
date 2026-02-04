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
        Schema::create('seguidores', function (Blueprint $table) {
            $table->integer('IDVinculo')->autoIncrement();
            $table->unsignedBigInteger('IDUsuarioSeguidor')->nullable(); // User FK (follower) should be not null usually but SQL says NOT NULL
            $table->integer('IDPlan')->nullable();
            $table->dateTime('FechaInicio')->nullable();
            $table->string('Estado', 50)->nullable();
            $table->timestamps();

            $table->foreign('IDUsuarioSeguidor')->references('id')->on('users');
            // Assuming IDPlan refers to planessuscripciones, though not in SQL dump constraints, it makes sense.
            // Leaving it as integer without constraint strictly adhering to Dump, 
            // OR adding constraint for consistency? User said "implement schema from vriv.sql". 
            // I will implement foreign key if it exists in SQL dump constraints.
            // SQL dump ONLY has constraint for IDUsuarioSeguidor.
            // So I will NOT add foreign key for IDPlan to be safe, or just index it.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguidores');
    }
};
