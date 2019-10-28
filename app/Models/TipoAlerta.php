<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TipoAlerta extends Pivot
{
    protected $table 	  = 'tipo_alerta';
	protected $primaryKey = 'id_tipo_alerta';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id_tipo_alerta',
	 	 	 	 	 	 	'id_status',
	 	 	 	 	 	 	'id_usuario',
	 	 	 	 	 	 	'nb_tipo_alerta',
	 	 	 	 	 	 	'nu_nivel_alerta',
	 	 	 	 	 	 	'tx_accion',
	 	 	 	 	 	 	'tx_imagen'
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
