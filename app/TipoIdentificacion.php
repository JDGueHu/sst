<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    protected $table = "tipos_identificacion";
	protected $fillable = ['llave','valor','activo'];
}
