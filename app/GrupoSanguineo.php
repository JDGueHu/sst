<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoSanguineo extends Model
{
    protected $table = "grupos_sanguineos";
    protected $fillable = ['llave','valor','activo'];
    
    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'grupo_sanguineo_id','id');
	}
}
