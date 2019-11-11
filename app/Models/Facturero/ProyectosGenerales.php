<?php

namespace App\Http\Models\Facturero;

use Illuminate\Database\Eloquent\Model;

class ProyectosGenerales extends Model
{
    //
    protected $connection = 'facturero';
    protected $table = 'proyectos_generales';
    protected $primaryKey = 'id_proyecto_general';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function espesificos()
    {
        return $this->hasMany(
            'App\Http\Models\Facturero\ProyectosEspesificos',
            'id_proyecto_general',
            'id_proyecto_general'
        );
    }
}
