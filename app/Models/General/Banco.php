<?php

namespace App\Http\Models\General;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $connection = 'general';
    protected $table = 'banco';
    protected $primaryKey = 'id_banco';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];


    public function scopeGrupo($query, $id_grupo)
    {
        return $query->where('tx_grupo', $id_grupo);
    }
    
    public function tipo()
    {
        return $this->belongsTo(
            'App\Http\Models\General\TipoBanco',
            'id_tipo_banco',
            'id_tipo_banco'
        );
    }

    public function contratistas()
    {
        return $this->hasMany(
            'App\Http\Models\Facturero\EmpresasContratistas',
            'id_banco',
            'id_banco'
        );
    }
}
