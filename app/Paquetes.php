<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquetes extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="paquetes";

    protected $fillable = [
        'nombre','estatus','precio','porcentaje','usuario'
    ];

    
    //
}
