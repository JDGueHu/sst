<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FondosCesantias extends Model
{
    protected $table = "fondos_cesantias";
    protected $fillable = ['llave','valor','activo'];
    
    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'fondo_cesantias_id','id');
    }
}
