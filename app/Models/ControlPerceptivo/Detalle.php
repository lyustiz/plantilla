<?php

namespace App\Http\Models\ControlPerceptivo;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $connection = 'control_perceptivo';
    protected $table = 'detalle';
    protected $primaryKey = 'id_detalle';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function controlPerceptivo()
    {
        return $this->belongsTo(
            'App\Http\Models\ControlPerceptivo\ControlPerceptivo',
            'id_control_perceptivo',
            'id_control_perceptivo'
        );
    }

    public function activos()
    {
        return $this->hasMany(
            'App\Http\Models\ControlPerceptivo\Activo',
            'id_detalle',
            'id_detalle'
        );
    }
}


