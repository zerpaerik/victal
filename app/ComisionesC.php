<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComisionesC extends Model
{

    protected $table="creditosc";

    protected $fillable = [
        'id_atencion', 'monto', 'porcentaje','id_responsable','id_origen', 'usuario','estatus','recibo','fecha_pago','detalle','tecnologo','fecha_entrega','usuario_entrega','tipo_entrega','tipop','archivo','usuario_archivo'
    ];
    //
}
