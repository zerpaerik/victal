<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetoPro extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="meto_pro";

    protected $fillable = [
        'nombre','estatus'
    ];

    
    //
}
