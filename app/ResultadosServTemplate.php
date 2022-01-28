<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadosServTemplate extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="resultados_serv_template";

    protected $fillable = [
        'id_servicio','subtitulo','id_resultado','valor','usuario'
    ];

    
    //
}