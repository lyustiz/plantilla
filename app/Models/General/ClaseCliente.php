<?php

namespace App\Http\Models\General;
use Illuminate\Database\Eloquent\Model;

class ClaseCliente extends Model
{
    protected $connection = 'general';
    protected $table = 'clase_cliente';
    protected $primaryKey = 'id_clase_cliente';
    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';
    protected $fillable = [
        'nb_clase_cliente',
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
            'id_clase_cliente',
            'id_clase_cliente'
        );
    }
}
