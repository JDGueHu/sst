<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ARL extends Model
{
    protected $table = "arl";
    protected $fillable = ['llave','valor','activo'];
    
    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'arl_id','id');
    }
}
