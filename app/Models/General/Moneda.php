<?php

namespace App\Http\Models\General;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $connection = 'general';
    protected $table = 'moneda';
    protected $primaryKey = 'id_moneda';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function scopeGrupo($query, $id_grupo)
    {
        return $query->where('tx_grupo', $id_grupo);
    }

    public function solicitud()
    {
        return $this->hasMany(
            'App\Http\Models\Dicom\Solicitud',
            'id_moneda',
            'co_bcv'
        );
    }

    public function transferencia()
    {
        return $this->hasMany(
            'App\Http\Models\Dicom\Transferencia',
            'id_moneda',
            'co_bcv'
        );
    }
    public function ordenacion()
    {
        return $this->hasMany(
            'App\Http\Models\Dicom\Ordenacion',
            'id_moneda',
            'co_bcv'
        );
    }
}
