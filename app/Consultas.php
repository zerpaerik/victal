<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{

    protected $table="consultas";

    protected $fillable = [
        'id_paciente', 'id_especialista', 'monto', 'usuario','estatus','sede','id_atencion','tipo','historia'
    ];
    //
}
