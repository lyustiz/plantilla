<?php

namespace App\Http\Models\Fas;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $connection   = 'fas';
    protected $table        = 'tramites';
    protected $primaryKey   = 'pk_id_tramite';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function siniestro()
    {
        return $this->belongsTo(
            'App\Http\Models\Fas\Siniestro', 
            'fk_id_siniestro', 
            'pk_id_siniestro'
        );
    }
}
