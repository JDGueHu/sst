<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFondosCesantias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fondos_cesantias', function (Blueprint $table) {
            $table->increments('id');

            $table->string('llave')->unique();
            $table->string('valor');
            $table->string('valor_por_defecto')->nullable();

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
        Schema::dropIfExists('fondos_cesantias');
    }
}
