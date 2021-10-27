<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comisiones extends Model
{

    protected $table="comisiones";

    protected $fillable = [
        'id_atencion', 'monto', 'porcentaje','id_responsable','id_origen', 'usuario','estatus','recibo','fecha_pago','detalle','tecnologo','fecha_entrega','usuario_entrega','tipo_entrega'
    ];
    //
}
