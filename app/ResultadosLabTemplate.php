<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadosLabTemplate extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="resultados_lab_template";

    protected $fillable = [
        'id_plantilla','id_laboratorio','id_resultado','valor','usuario'
    ];

    
    //
}