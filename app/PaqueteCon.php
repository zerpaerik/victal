<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteCon extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="paquetes_c";

    protected $fillable = [
        'paquete','cantidad'
    ];

    
    //
}