<?php

namespace App\Http\Models\ControlPerceptivo;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    protected $connection = 'control_perceptivo';
    protected $table = 'activo';
    protected $primaryKey = 'id_activo';


    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function detalle(){
        return $this->belongsTo(
            'App\Http\Models\ControlPerceptivo\Detalle', 
            'id_detalle', 
            'id_detalle'
        );
    }

}