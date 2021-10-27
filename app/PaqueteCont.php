<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteCont extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="paquetes_co";

    protected $fillable = [
        'paquete','cantidad'
    ];

    
    //
}