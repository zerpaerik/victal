<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCon extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="tipo_con";

    protected $fillable = [
        'nombre'
    ];

    
    //
}
