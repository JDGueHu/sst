<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FondosCesantias extends Model
{
    protected $table = "fondos_cesantias";
	protected $fillable = ['llave','valor','activo'];
}
