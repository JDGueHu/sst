<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarTablaCentrosTrabajo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros_trabajo', function (Blueprint $table) {
            $table->increments('id');
    
            $table->string('codigo')->unique();
            $table->string('nombre');

            $table->integer('nivel_riesgo_id')->nullable()->unsigned();
            $table->foreign('nivel_riesgo_id')->references('id')->on('niveles_riesgo');

            $table->boolean('activo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centros_trabajo');
    }
}
