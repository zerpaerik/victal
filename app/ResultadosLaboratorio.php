<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadosLaboratorio extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table="resultados_laboratorio";

    protected $fillable = [
        'id_atencion','id_laboratorio','estatus','informe','usuario_informe','informe_guarda'
    ];

    public function selectLabs($id)
    {

        $array='';
        $data = \DB::table('resultados_laboratorio')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_atec_paquete', $id)
        ->get();
        $descripcion='';
        
        
        foreach ($data as $key => $value) {

          $dataproductos = \DB::table('analisis')
          ->select('*')
          ->where('id', $value->id_laboratorio)
          ->get();
          foreach ($dataproductos as $key => $valueproducto) {
            $descripcion.= $valueproducto->nombre.'- '.'';
                          # code...
        }
    }

    return substr($descripcion, 0, -1);
              //  return $id;
}

    
    
}