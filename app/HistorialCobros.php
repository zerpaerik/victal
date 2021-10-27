<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialCobros extends Model
{

    protected $table="historial_cobros";

    protected $fillable = [
        'id_cobro', 'monto','sede','tipopago'
    ];
    //
}
