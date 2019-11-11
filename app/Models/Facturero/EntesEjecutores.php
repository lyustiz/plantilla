<?php

namespace App\Http\Models\Facturero;

use Illuminate\Database\Eloquent\Model;

class EntesEjecutores extends Model
{
    protected $connection = 'facturero';
    protected $table = 'entes_ejecutores';
    protected $primaryKey = 'id_ente_ejecutor';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];
}
