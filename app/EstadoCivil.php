<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = "estados_civiles";
    protected $fillable = ['codigo','nombre','nivel_riesgo_id'];
    
    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'estado_civil_id','id');
    }
}
