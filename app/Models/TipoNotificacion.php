<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoNotificacion extends Model
{
    /** @use HasFactory<\Database\Factories\TipoNotificacionFactory> */
    use HasFactory;

    protected $table = 'tiponotificaciones';
    protected $primaryKey = 'IDTipoNotificacion';

    protected $fillable = [
        'Nombre',
        'Descripcion',
    ];
}
