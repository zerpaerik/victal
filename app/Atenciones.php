<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atenciones extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="atenciones";

    protected $fillable = [
        'tipo_origen','id_origen','tipo_atencion','id_tipo', 'id_paciente','monto','abono','resta','estatus','llego','tipo_pago','eliminado_por','usuario','sede','pagado','atendido'
    ];

    
    //
}
