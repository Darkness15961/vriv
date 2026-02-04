<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanSuscripcion extends Model
{
    /** @use HasFactory<\Database\Factories\PlanSuscripcionFactory> */
    use HasFactory;

    protected $table = 'planessuscripciones';
    protected $primaryKey = 'IDPlan';

    protected $fillable = [
        'IDCreador',
        'Nombre',
        'Descripcion',
        'Precio',
        'Periodicidad',
    ];
}
