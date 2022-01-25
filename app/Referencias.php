<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referencias extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="referencias";

    protected $fillable = [
        'nombre'
    ];

    
    //
}
