<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="pacientes";

    protected $fillable = [
        'nombre','apellidos','tipo_doc','dni','direccion','telefono','email','fechanac','estatus','ocupacion','edocivil','empresa','usuario','sexo'
    ];

    
    //
}
