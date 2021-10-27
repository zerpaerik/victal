<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadosLaboratorio extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="resultados_laboratorio";

    protected $fillable = [
        'id_atencion','id_laboratorio','estatus','informe','usuario_informe','informe_guarda'
    ];

    
    //
}