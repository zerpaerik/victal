<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplatesReferencia extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="template_referencia";

    protected $fillable = [
        'nombre','id_plantilla'
    ];

    
    //
}
