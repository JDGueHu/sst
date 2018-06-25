<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EPS extends Model
{
    protected $table = "eps";
	protected $fillable = ['llave','valor','activo'];
}
