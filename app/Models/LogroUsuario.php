<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogroUsuario extends Model
{
    /** @use HasFactory<\Database\Factories\LogroUsuarioFactory> */
    use HasFactory;

    protected $table = 'logrousuarios';
    protected $primaryKey = 'ID_LogroUsuario';

    protected $fillable = [
        'IDUsuario',
        'IDLogro',
        'FechaObtencion',
    ];
}
