<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadosServicios extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="resultados_servicios";

    protected $fillable = [
        'id_atencion','id_servicio','estatus','informe','usuario_informe','informe_guarda'
    ];

    
    //
}