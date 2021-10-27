<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaqueteLab extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="paquetes_l";

    protected $fillable = [
        'paquete','laboratorio'
    ];

    
    public function laboratorio()
    {
      return $this->hasOne('App\Analisis','id','laboratorio');
    }

    
    //
}
