<?php

namespace App\Http\Models\General;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $connection = 'general';
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $fillable = [
        'nb_cliente',
        'tx_rif',
        'tx_direccion',
        'tx_telefono',
        'tx_contacto',
        'tx_email',
        'id_tipo_cliente',
        'id_clase_cliente',
        'tx_observaciones',
        'tx_grupo',
        'id_status',
        'id_tipo',
        'id_usuario',
        'fe_creado',
        'fe_actualizado'
    ];

    public function scopeGrupo($query, $id_grupo)
    {
        return $query->where('tx_grupo', $id_grupo);
    }

    public function tipo()
    {
        return $this->belongsTo(
            'App\Http\Models\General\TipoCliente',
            'id_tipo_cliente',
            'id_tipo_cliente'
        );
    }
    public function clase()
    {
        return $this->belongsTo(
            'App\Http\Models\General\ClaseCliente',
            'id_clase_cliente',
            'id_clase_cliente'
        );
    }
    public function status()
    {
        return $this->belongsTo(
            'App\Http\Models\General\Status',
            'id_status',
            'id_status'
        );
    }
}