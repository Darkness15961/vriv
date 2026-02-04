<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participacion extends Model
{
    /** @use HasFactory<\Database\Factories\ParticipacionFactory> */
    use HasFactory;

    protected $table = 'participacion';
    protected $primaryKey = 'IDParticipacion';

    protected $fillable = [
        'IDUsuario',
        'IDEvento',
        'FechaParticipacion',
        'EsGanador',
        'PuntajeEvento',
        'TiempoLogrado',
    ];
}
