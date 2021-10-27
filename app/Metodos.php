<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metodos extends Model
{

    protected $table="metodos";

    protected $fillable = [
        'id_paciente', 'id_producto', 'monto', 'usuario','estatus','sede','id_atencion','usuario_llama','peso','talla','observacion','usuario_aplica','fecha_aplica','prox_aplica'
    ];
    //
}
