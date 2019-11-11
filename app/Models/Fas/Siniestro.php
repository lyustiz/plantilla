<?php

namespace App\Http\Models\Fas;

use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    protected $connection   = 'fas';
    protected $table        = 'siniestros';
    protected $primaryKey   = 'pk_id_siniestro';
    
    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';
    
    protected $guarded = [];

    public function tramite()
    {
        return $this->hasMany(
            'App\Http\Models\Fas\Tramite', 
            'fk_id_siniestro',
            'pk_id_siniestro'
        );
    }
}

