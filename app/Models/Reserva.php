<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'moto_id',
        'fecha_recogida',
        'fecha_entrega',
        // añade aquí cliente, observaciones…
    ];

    public function moto()
    {
        return $this->belongsTo(Moto::class);
    }
}