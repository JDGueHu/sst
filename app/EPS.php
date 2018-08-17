<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EPS extends Model
{
    protected $table = "eps";
    protected $fillable = ['llave','valor','activo'];
    
    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'eps_id','id');
    }
}
