<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasDetalle extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="ventas_detalle";

    protected $fillable = [
        'id_venta','id_producto','cantidad','monto','total','usuario','cliente'
    ];

    
    //
}
