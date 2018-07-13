<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cargo;
use App\NivelRiesgo;

class cargosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = DB::table('cargos')
            ->leftJoin('niveles_riesgo', 'cargos.nivel_riesgo_id', '=', 'niveles_riesgo.id')
            ->where('cargos.activo',true)
            ->select('cargos.*', 'niveles_riesgo.llave', 'niveles_riesgo.valor')
            ->get();
        
        $niveles_riesgo = NivelRiesgo::select(DB::raw("CONCAT('', llave, ' - ', valor) AS nombre"),'id')->get()->pluck('nombre','id');

        // Se consulta el valor por defecto y se envía el id del marcado como default en caso que exista
        $nivel_riesgo_default = NivelRiesgo::whereNotNull('valor_por_defecto')->first();
        if($nivel_riesgo_default != null){$nivel_riesgo_default = $nivel_riesgo_default->id;}


        return view('administracion.parametros.cargos.index')
            ->with('cargos',$cargos)
            ->with('niveles_riesgo',$niveles_riesgo)
            ->with('nivel_riesgo_default',$nivel_riesgo_default);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
