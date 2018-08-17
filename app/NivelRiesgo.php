<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelRiesgo extends Model
{
    protected $table = "niveles_riesgo";
    protected $fillable = ['llave','valor','activo'];

    public function centrosTrabajo()
	{
		return $this->hasMany('App\CentroTrabajo', 'nivel_riesgo_id','id');
    }

    public function cargos()
	{
		return $this->hasMany('App\Cargo', 'nivel_riesgo_id','id');
    }

}
