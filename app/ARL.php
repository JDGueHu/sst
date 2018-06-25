<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ARL extends Model
{
    protected $table = "arl";
	protected $fillable = ['llave','valor','activo'];
}
