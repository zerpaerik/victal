<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="servicios";

    protected $fillable = [
        'nombre','tipo','precio','porcentaje','porcentaje1','porcentaje2','estatus'
    ];

    
    //
}
