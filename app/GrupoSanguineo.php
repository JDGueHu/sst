<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoSanguineo extends Model
{
    protected $table = "grupos_sanguineos";
	protected $fillable = ['llave','valor','activo'];
}
