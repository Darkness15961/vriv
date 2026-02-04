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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('idTipoUsuario')->nullable()->after('google_id');
            $table->string('FotoPerfil', 255)->nullable()->after('email');
            $table->text('BiografiaDescripcion')->nullable()->after('idTipoUsuario');
            $table->integer('PuntosScore')->default(0)->after('BiografiaDescripcion');
            $table->string('Direccion', 255)->nullable()->after('PuntosScore');

            $table->foreign('idTipoUsuario')->references('idTipoUsuarios')->on('tipousuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['idTipoUsuario']);
            $table->dropColumn(['idTipoUsuario', 'FotoPerfil', 'BiografiaDescripcion', 'PuntosScore', 'Direccion']);
        });
    }
};
