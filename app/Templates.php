<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="templates";

    protected $fillable = [
        'nombre','id_laboratorio','referencia','medida','metodo','subtitulo'
    ];

    
    //
}
