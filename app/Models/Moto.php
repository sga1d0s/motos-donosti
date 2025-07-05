<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $fillable = [
        'modelo',
        'matricula',
        'kilometros',
        'fecha_itv',
        'estado',
        'comentarios',
    ];

    protected $casts = [
        'fecha_itv' => 'date',
    ];
}
