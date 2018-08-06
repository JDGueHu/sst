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
}
