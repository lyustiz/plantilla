<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'auth';
    protected $table 	  = 'usuario';
    protected $primaryKey = 'id_usuario';

    const CREATED_AT = 'fe_creado';
    const UPDATED_AT = 'fe_actualizado';
	
	
    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
	
	
	public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }

}
