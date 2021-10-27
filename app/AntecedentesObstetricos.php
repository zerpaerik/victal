<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedentesObstetricos extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="antecedentes_obstetricos";

    protected $fillable = [
        'id_paciente','gestas','abortos','vaginales','nac_vivos','viven','parto','cesarea','nac_muertos','ant_fam','ant_pers','gest_ant','fecha_ant','tipo_aborto','mayor_peso','peso','talla','tipo_sangre','sangre','fun','fpp','ecoeg','orina','fec_orina','urea','fec_urea','creatinina','fec_creati','bk','fec_bk','torch','fec_torch','usuario'
    ];

    
    //
}
