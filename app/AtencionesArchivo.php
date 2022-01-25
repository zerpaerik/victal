<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtencionesArchivo extends Model
{

    protected $table="atenciones_archivo";

    protected $fillable = [
        'id','id_atencion','archivo'
    ];
    //
}
