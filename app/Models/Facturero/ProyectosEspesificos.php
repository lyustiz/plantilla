<?php

namespace App\Http\Models\Facturero;

use Illuminate\Database\Eloquent\Model;

class ProyectosEspesificos extends Model
{
    //
    protected $connection = 'facturero';
    protected $table = 'proyectos_especificos';
    protected $primaryKey = 'id_proyecto_espesifico';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function general()
    {
        return $this->hasMany(
            'App\Http\Models\Facturero\ProyectosGenerales',
            'id_proyecto_general',
            'id_proyecto_general'
        );
    }
}
