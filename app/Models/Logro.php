<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logro extends Model
{
    /** @use HasFactory<\Database\Factories\LogroFactory> */
    use HasFactory;

    protected $table = 'logros';
    protected $primaryKey = 'id_Logro';

    protected $fillable = [
        'Nombre',
        'Descripcion',
        'ImagenURL',
        'PuntosOtorgados',
    ];
}
