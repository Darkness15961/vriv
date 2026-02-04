<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    /** @use HasFactory<\Database\Factories\PremioFactory> */
    use HasFactory;

    protected $table = 'premios';
    protected $primaryKey = 'IDPremio';

    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Imagen_URL',
        'Stock',
        'ValorReferencial',
        'Proveedor',
        'EsEnvio',
    ];
}
