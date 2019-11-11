<?php

namespace App\Http\Models\ControlPerceptivo;

use Illuminate\Database\Eloquent\Model;

class ControlPerceptivo extends Model
{
    protected $connection = 'control_perceptivo';
    protected $table = 'control_perceptivo';
    protected $primaryKey = 'id_control_perceptivo';


    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function detalles(){
        return $this->hasMany(
            'App\Http\Models\ControlPerceptivo\Detalle', 
            'id_control_perceptivo', 
            'id_control_perceptivo'
        );
    }

    public function facturas(){
        return $this->hasMany(
            'App\Http\Models\ControlPerceptivo\Factura', 
            'id_control_perceptivo', 
            'id_control_perceptivo'
        );
    }
}

