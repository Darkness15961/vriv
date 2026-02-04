<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    /** @use HasFactory<\Database\Factories\TransaccionFactory> */
    use HasFactory;

    protected $table = 'transacciones';
    protected $primaryKey = 'IDTransaccion';

    protected $fillable = [
        'IDUsuario',
        'Monto',
        'Moneda',
        'IDReferenciaOrigen',
        'TipoTransaccion',
        'MetodoPago',
        'Estado',
        'FechaTransaccion',
    ];
}
