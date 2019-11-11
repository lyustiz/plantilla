<?php

namespace App\Http\Models\General;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $connection = 'general';
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';
    protected $fillable = [
        'nb_status',
        'tx_grupo',
        'nb_status2',
        'id_tipo',
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
    public function subasta()
    {
        return $this->hasMany(
            'App\Http\Models\General\Cliente',
            'id_subasta',
            'id_subasta'
        );
    }

    public function detsolicitud(){
        return $this->hasMany(
            'App\Http\Models\Dicom\DetSolicitud', 
            'id_status'
        );
    }
}
