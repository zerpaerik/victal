<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplatesS extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="templates_s";

    protected $fillable = [
        'subtitulo','id_servicio'
    ];

    
    //
}
