<?php

namespace App\Http\Models\ControlPerceptivo;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $connection = 'control_perceptivo';
    protected $table = 'factura';
    protected $primaryKey = 'id_factura';


    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function controlPerceptivo(){
        return $this->belongsTo(
            'App\Http\Models\ControlPerceptivo\ControlPerceptivo', 
            'id_control_perceptivo', 
            'id_control_perceptivo'
        );
    }

}