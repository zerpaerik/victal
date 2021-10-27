<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagosPersonal extends Model
{

    protected $table="pagos_personal";

    protected $fillable = [
        'id_personal', 'monto', 'usuario', 'sede','fecha'
    ];
    //
}
