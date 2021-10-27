<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{

    protected $table="control";

    protected $fillable = [
        'id_consulta', 'id_paciente', 'sem', 'peso','temp','ten','alt','press','fcf','mov','edema','pulso','conse','sulfato','perfil','sero','fec_sero','gluco','fec_gluco','vih','fec_vih','hemo','fec_hemo','piel','abdomen','mamas','gen_int','gen_ext','miem','diag','ex','diag_def','plan','prox','usuario'
    ];
    //
}
