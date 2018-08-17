<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = "empleados";
    protected $fillable = ['tipo_identificacion_id','identificacion','nombres'];

    public function tipoIdentificacion()
    {
        return $this->belongsTo('App\TipoIdentificacion','tipo_identificacion_id');
    }

    public function genero()
    {
        return $this->belongsTo('App\Genero','tipo_identificacion_id');
    }

    public function grupoSanguineo()
    {
        return $this->belongsTo('App\GrupoSanguineo','grupo_sanguineo_id');
    }

    public function estadoCivil()
    {
        return $this->belongsTo('App\EstadoCivil','estado_civil_id');
    }

    public function eps()
    {
        return $this->belongsTo('App\EPS','eps_id');
    }

    public function arl()
    {
        return $this->belongsTo('App\ARL','arl_id');
    }

    public function fondoCesantias()
    {
        return $this->belongsTo('App\FondosCesantias','fondo_cesantias_id');
    }

    public function fondoPensiones()
    {
        return $this->belongsTo('App\FondosCesantias','fondo_pensiones_id');
    }

    public function cargo()
    {
        return $this->belongsTo('App\Cargo','cargo_id');
    }

    public function area()
    {
        return $this->belongsTo('App\Area','area_id');
    }

    public function centroTrabajo()
    {
        return $this->belongsTo('App\CentroTrabajo','centro_trabajo_id');
    }
}
