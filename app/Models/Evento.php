<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evento extends Model
{
    /** @use HasFactory<\Database\Factories\EventoFactory> */
    use HasFactory;

    protected $table = 'eventos';
    protected $primaryKey = 'IDEvento';

    protected $fillable = [
        'Nombre',
        'Descripcion',
        'IDCreador',
        'PuntosMinimos',
        'IDPlanMinimo',
        'IDTipoEvento',
        'FechaInicio',
        'FechaFin',
        'Estado',
        'ReglasBases',
    ];
}
