<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Status extends Pivot
{
    protected $table 	  = 'status';
	protected $primaryKey = 'id_status';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id_status',
	 	 	 	 	 	 	'nb_status',
	 	 	 	 	 	 	'in_grupo_status',
	 	 	 	 	 	 	'nb_grupo_status',
	 	 	 	 	 	 	'nb_status2',
	 	 	 	 	 	 	'nu_orden',
	 	 	 	 	 	 	'nu_orden2',
	 	 	 	 	 	 	'id_usuario'
                            ]; 
    
    protected $hidden     = [
                            'fe_creado',
	 	 	 	 	 	 	'fe_actualizado'
                            ];


}
