<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriaBase extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="historia_base";

    protected $fillable = [
        'id_paciente','ant_pat','ant_per','ant_fam','sex','alergias'
    ];

    
    //
}
