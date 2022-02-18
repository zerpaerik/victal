<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtencionesArchivo extends Model
{

    protected $table="archivo_atenciones";

    protected $fillable = [
        'id','id_atencion','archivo','usuario'
    ];
    //
}
