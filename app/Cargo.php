<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = "cargos";
	protected $fillable = ['codigo','nombre','nivel_riesgo_id'];
}
