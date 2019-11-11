<?php

namespace App\Http\Models\Dicom;
use Illuminate\Database\Eloquent\Model;

class Subasta extends Model
{
    protected $connection = 'dicom';
    protected $table = 'subasta';
    protected $primaryKey = 'id_subasta';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $fillable = [
        'nu_subasta',
        'co_subasta',
        'fe_subasta',
        'fe_cierre',
        'fe_adjudicacion',
        'fe_publicacion',
        'fe_liquidacion',
        'fe_valor',
        'tx_observaciones',
        'id_status',
        'id_tipo',
        'id_usuario',
        'fe_creado',
        'fe_actualizado'
    ];
    
    public function status()
    {
        return $this->belongsTo(
            'App\Http\Models\General\Status',
            'id_status',
            'id_status'
        );
    }
}
