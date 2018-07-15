<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarTablaEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tipo_identificacion_id')->unsigned();
            $table->foreign('tipo_identificacion_id')->references('id')->on('tipos_identificacion');

            $table->string('identificacion')->unique();
            $table->string('nombres');
            $table->string('apellidos');

            $table->integer('genero_id')->unsigned();
            $table->foreign('genero_id')->references('id')->on('generos');

            $table->integer('grupo_sanguineo_id')->unsigned();
            $table->foreign('grupo_sanguineo_id')->references('id')->on('grupos_sanguineos');
        
            $table->date('fecha_nacimiento');
            $table->string('ciudad_nacimiento');
            $table->string('departamento_nacimiento')->nullable();
            $table->string('pais_nacimiento')->nullable();
        
            $table->integer('estado_civil_id')->unsigned();
            $table->foreign('estado_civil_id')->references('id')->on('estados_civiles');

            $table->integer('numeroHijos')->nullable();
            $table->string('ciudadDireccion');
            $table->string('departamentoDireccion')->nullable();
            $table->string('paisDireccion')->nullable();
            $table->string('direccion');
            $table->string('emailPersonal');
            $table->string('telefonoFijo')->nullable();
            $table->string('telefonoCelular');
            $table->string('emailCorporativo')->nullable();

            $table->integer('eps_id')->unsigned();
            $table->foreign('eps_id')->references('id')->on('eps');  

            $table->integer('arl_id')->unsigned();
            $table->foreign('arl_id')->references('id')->on('arl');  

            $table->integer('fondo_cesantias_id')->unsigned();
            $table->foreign('fondo_cesantias_id')->references('id')->on('fondos_cesantias');

            $table->integer('fondo_pensiones_id')->unsigned();
            $table->foreign('fondo_pensiones_id')->references('id')->on('fondos_pensiones');  
            
            $table->integer('cargo_id')->unsigned();
            $table->foreign('cargo_id')->references('id')->on('cargos');  

            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas'); 

            $table->integer('centro_trabajo_id')->unsigned();
            $table->foreign('centro_trabajo_id')->references('id')->on('centros_trabajo'); 
            
            $table->string('estado');

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
        Schema::dropIfExists('empleados');
    }
}
