<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelRiesgo extends Model
{
    protected $table = "niveles_riesgo";
    protected $fillable = ['llave','valor','activo'];

}
