<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FondoPensiones extends Model
{
    protected $table = "fondos_pensiones";
	protected $fillable = ['llave','valor','activo'];
}
