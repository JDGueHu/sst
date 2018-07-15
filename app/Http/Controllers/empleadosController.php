<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\TipoIdentificacion;
use App\Genero;

class empleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::where('activo',true)->get();

        return view('empleados.index')
            ->with('empleados',$empleados);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tipos_identificacion = TipoIdentificacion::where('activo',true)->pluck('valor','id');
        $tipo_identificacion_default = TipoIdentificacion::whereNotNull('valor_por_defecto')->first();
        if($tipo_identificacion_default != null){$tipo_identificacion_default = $tipo_identificacion_default->id;}

        $generos = Genero::where('activo',true)->pluck('valor','id');
        $generos_default = Genero::whereNotNull('valor_por_defecto')->first();
        if($generos_default != null){$generos_default = $generos_default->id;}

        $grupos_sanguineos = TipoIdentificacion::where('activo',true)->pluck('valor','id');
        $grupos_sanguineos_default = TipoIdentificacion::whereNotNull('valor_por_defecto')->first();
        if($grupos_sanguineos_default != null){$grupos_sanguineos_default = $grupos_sanguineos_default->id;}

        return view('empleados.create')
            ->with('tipos_identificacion',$tipos_identificacion)
            ->with('tipo_identificacion_default',$tipo_identificacion_default)
            ->with('generos',$generos)
            ->with('generos_default',$generos_default)
            ->with('grupos_sanguineos',$grupos_sanguineos)
            ->with('grupos_sanguineos_default',$grupos_sanguineos_default);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
