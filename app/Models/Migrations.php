<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Migrations extends Pivot
{
    protected $table 	  = 'migrations';
	protected $primaryKey = 'id';
	
	const 	  CREATED_AT  = 'fe_creado';
	const 	  UPDATED_AT  = 'fe_actualizado';

    protected $fillable   = [
                            'id',
	 	 	 	 	 	 	'migration',
	 	 	 	 	 	 	'batch'
                            ]; 
    
    protected $hidden     = [
                            'fe_creado',
	 	 	 	 	 	 	'fe_actualizado'
                            ];


}
