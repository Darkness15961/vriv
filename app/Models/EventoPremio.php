<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoPremio extends Model
{
    /** @use HasFactory<\Database\Factories\EventoPremioFactory> */
    use HasFactory;

    protected $table = 'eventopremio';
    protected $primaryKey = 'IDEventoPremio';

    protected $fillable = [
        'IDEvento',
        'IDPremio',
        'Cantidad',
        'PosicionGanador',
    ];
}
