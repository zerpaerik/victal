<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtitulos extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="subtitulos";

    protected $fillable = [
        'nombre','estatus'
    ];

    
    //
}
