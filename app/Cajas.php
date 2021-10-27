<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cajas extends Model
{

    protected $table="cajas";

    protected $fillable = [
        'primer_turno', 'segundo_turno', 'usuario_primer', 'usuario_segundo', 'fecha','total','estatus','sede'
    ];
    //
}
