<?php

namespace App\Http\Models\General;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    protected $connection = 'general';
    protected $table = 'tipo_cliente';
    protected $primaryKey = 'id_tipo_cliente';
    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';
    protected $fillable = [
        'id_tipo_cliente',
        'nb_tipo_cliente',
        'co_tipo_cliente',
        'tx_grupo',
        'id_tipo',
        'id_status',
        'id_usuario',
        'fe_creado',
        'fe_actualizado'
    ];

    public function scopeGrupo($query, $id_grupo)
    {
        return $query->where('tx_grupo', $id_grupo);
    }

    public function cliente()
    {
        return $this->hasMany(
            'App\Http\Models\General\Cliente',
            'id_tipo_cliente',
            'id_tipo_cliente'
        );
    }
}
