<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    protected $table = "tipos_identificacion";
    protected $fillable = ['llave','valor','activo'];
    
    public function Empleados()
	{
		return $this->hasMany('App\Empleado', 'genero_id','id');
    }
    
}
