<?php

namespace App\Http\Models\General;
use Illuminate\Database\Eloquent\Model;

class TipoBanco extends Model
{
    protected $connection = 'general';
    protected $table = 'tipo_banco';
    protected $primaryKey = 'id_tipo_banco';
    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';
    protected $guarded = [];

    public function scopeGrupo($query, $id_grupo)
    {
        return $query->where('tx_grupo', $id_grupo);
    }

    public function bancos()
    {
        return $this->hasMany(
            'App\Http\Models\General\Banco',
            'id_tipo_banco',
            'id_tipo_banco'
        );
    }
}
