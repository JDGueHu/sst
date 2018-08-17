<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroTrabajo extends Model
{
    protected $table = "centros_trabajo";
    protected $fillable = ['codigo','nombre','nivel_riesgo_id'];

    public function nivelRiesgo()
    {
        return $this->belongsTo('App\NivelRiesgo','nivel_riesgo_id');
    }

    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'centro_trabajo_id','id');
    }

}
