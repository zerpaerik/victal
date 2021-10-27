<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteServ extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="paquetes_s";

    protected $fillable = [
        'paquete','servicio'
    ];


    public function servicio()
    {
      return $this->hasOne('App\Servicios','id','servicio');
    }

    
    //
}
