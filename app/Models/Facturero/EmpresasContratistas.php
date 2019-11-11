<?php

namespace App\Http\Models\Facturero;

use Illuminate\Database\Eloquent\Model;

class EmpresasContratistas extends Model
{
    //
    protected $connection = 'facturero';
    protected $table = 'empresas_contratistas';
    protected $primaryKey = 'id_empresa_contratista';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';

    protected $guarded = [];

    public function banco()
    {
        return $this->belongsTo(
            'App\Http\Models\General\Banco',
            'id_banco',
            'id_banco'
        );
    }
}
