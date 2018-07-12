<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroTrabajo extends Model
{
    protected $table = "centros_trabajo";
    protected $fillable = ['codigo','nombre','nivel_riesgo_id'];

}
