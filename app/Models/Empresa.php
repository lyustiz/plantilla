<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Empresa extends Pivot
{
    protected $table 	  = 'empresa';
	protected $primaryKey = 'id_empresa';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id_empresa',
	 	 	 	 	 	 	'id_status',
	 	 	 	 	 	 	'id_usuario',
	 	 	 	 	 	 	'nb_empresa',
	 	 	 	 	 	 	'tx_rif',
	 	 	 	 	 	 	'tx_direccion',
	 	 	 	 	 	 	'tx_telefono',
	 	 	 	 	 	 	'tx_contacto',
	 	 	 	 	 	 	'tx_correo',
	 	 	 	 	 	 	'id_tipo_empresa',
	 	 	 	 	 	 	'id_pais',
	 	 	 	 	 	 	'id_region1',
	 	 	 	 	 	 	'id_region2',
	 	 	 	 	 	 	'id_region3',
	 	 	 	 	 	 	'tx_observaciones',
	 	 	 	 	 	 	'id_empresa_ppal'
                            ]; 
    
    protected $hidden     = [
                            'fe_creado',
	 	 	 	 	 	 	'fe_actualizado'
                            ];

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'id_status');
    } 

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario');
    } 
}
