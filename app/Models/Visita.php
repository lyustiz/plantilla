<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Visita extends Pivot
{
    protected $table 	  = 'visita';
	protected $primaryKey = 'id_visita';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id_visita',
	 	 	 	 	 	 	'id_visitante',
	 	 	 	 	 	 	'id_tipo_visitante',
	 	 	 	 	 	 	'id_empresa',
	 	 	 	 	 	 	'id_motivo',
	 	 	 	 	 	 	'id_status',
	 	 	 	 	 	 	'id_usuario',
	 	 	 	 	 	 	'nu_ced_empleado',
	 	 	 	 	 	 	'tx_cargo',
	 	 	 	 	 	 	'tx_observaciones',
	 	 	 	 	 	 	'nu_carnet',
	 	 	 	 	 	 	'fe_entrada',
	 	 	 	 	 	 	'fe_salida'
                            ]; 
    
    protected $hidden     = [
                            'fe_creado',
	 	 	 	 	 	 	'fe_actualizado'
                            ];

    public function visitante()
    {
        return $this->belongsTo('App\Models\Visitante', 'id_visitante');
    } 

    public function tipoVisitante()
    {
        return $this->belongsTo('App\Models\TipoVisitante', 'id_tipo_visitante');
    } 

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'id_empresa');
    } 

    public function motivo()
    {
        return $this->belongsTo('App\Models\Motivo', 'id_motivo');
    } 

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'id_status');
    } 

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario');
    } 
}
