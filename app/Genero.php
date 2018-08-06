<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = "generos";
    protected $fillable = ['llave','valor','activo'];
    
    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'genero_id','id');
	}
}
