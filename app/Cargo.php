<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = "cargos";
    protected $fillable = ['codigo','nombre','nivel_riesgo_id'];
    
    public function nivelRiesgo()
    {
        return $this->belongsTo('App\NivelRiesgo','nivel_riesgo_id');
    }
    
    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'cargo_id','id');
    }
}
