<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaR extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="historia_r";

    protected $fillable = [
        'id_historia','id_producto','consulta','texto','observacion'
    ];

    
    //
}
