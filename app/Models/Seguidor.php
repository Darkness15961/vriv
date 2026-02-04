<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    /** @use HasFactory<\Database\Factories\SeguidorFactory> */
    use HasFactory;

    protected $table = 'seguidores';
    protected $primaryKey = 'IDVinculo';

    protected $fillable = [
        'IDUsuarioSeguidor',
        'IDPlan',
        'FechaInicio',
        'Estado',
    ];
}
