<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaP extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="historia_p";

    protected $fillable = [
        'id_historia','id_paquete','consulta'
    ];

    
    //
}
