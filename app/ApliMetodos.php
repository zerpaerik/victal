<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApliMetodos extends Model
{

    protected $table="apli_metodos";

    protected $fillable = [
        'metodo', 'talla', 'peso', 'usuario','observacion','paciente'
    ];
    //
}
