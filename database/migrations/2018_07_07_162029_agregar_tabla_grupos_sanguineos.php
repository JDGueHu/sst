<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarTablaGruposSanguineos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_sanguineos', function (Blueprint $table) {
            $table->increments('id');
    
            $table->string('llave')->unique();
            $table->string('valor');
            $table->string('valor_por_defecto')->nullable();
            $table->string('padre')->nullable();

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
        Schema::dropIfExists('grupos_sanguineos');
    }
}
