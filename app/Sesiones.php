<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesiones extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="sesiones";

    protected $fillable = [
        'id_paciente','id_atencion','estatus','id_personal',
    ];

    
    //
}
