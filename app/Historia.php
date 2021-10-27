<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{

    protected $table="historia";

    protected $fillable = [
        'id_paciente', 'id_consulta','id_especialista','tipopago','motivo','pa','pulso','temp','peso','talla','apetito','sed','animo','mic','rc','dep','fur','pap','mac','andria','g','p','piel','mamas','abdomen','ext','int','miem','evo','tipo','pd','df','cie','cie1','ex_aux','plan','obser','prox','usuario','reevalua','observacion','usuario_reevalua'
    ];
    //
}
