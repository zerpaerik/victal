<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobrar extends Model
{

    protected $table="cuentas_cobrar";

    protected $fillable = [
        'id_atencion', 'estatus', 'resta', 'detalle'
    ];
    //
}
