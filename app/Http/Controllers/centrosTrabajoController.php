<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\CentroTrabajo;
use App\NivelRiesgo;

class centrosTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centros_trabajo = DB::table('centros_trabajo')
        ->leftJoin('niveles_riesgo', 'centros_trabajo.nivel_riesgo_id', '=', 'niveles_riesgo.id')
        ->where('centros_trabajo.activo',true)
        ->select('centros_trabajo.*', 'niveles_riesgo.llave', 'niveles_riesgo.valor')
        ->get();
        
        $niveles_riesgo = NivelRiesgo::select(DB::raw("CONCAT('', llave, ' - ', valor) AS nombre"),'id')->get()->pluck('nombre','id');

        // Se consulta el valor por defecto y se envía el id del marcado como default en caso que exista
        $nivel_riesgo_default = NivelRiesgo::whereNotNull('valor_por_defecto')->first();
        if($nivel_riesgo_default != null){$nivel_riesgo_default = $nivel_riesgo_default->id;}


        return view('administracion.parametros.centros_trabajo.index')
            ->with('centros_trabajo',$centros_trabajo)
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

    // Validación de duplicidad de registro Ajax
    public function validarDuplicado(Request $request)
    {
        if($request->ajax()){ 

            //El valor de la variable módulo es la tabla en la que se debe validar la duplicidad
            
            $duplicado = 1;
            $registro = DB::table($request->modulo)
                ->where('codigo', '=', $request->codigo)
                ->where('activo',true)
                ->get();

            if ($registro->count() == 0) {
                $duplicado = 0;       
            }

            return $duplicado;

        }
    }

    // Creación de nuevo registro Ajax
    public function crearAjax(Request $request)
    {
        if($request->ajax()){      
            
            try{

                // Se crea el registro en la tabla sin tener en cuenta aun si es la opción 
                // por defecto
                $registro = DB::table($request->modulo)->insert(
                    [
                    'codigo' => $request->codigo,
                    'nombre' => $request->nombre,
                    'nivel_riesgo_id' => $request->nivel_riesgo_id
                    ]
                );

                // $registros = DB::table($request->modulo)
                //                     ->orderBy('codigo', 'asc')->get();
                
                $registros = DB::table($request->modulo)
                    ->leftJoin('niveles_riesgo', $request->modulo.'.nivel_riesgo_id', '=', 'niveles_riesgo.id')
                    ->where($request->modulo.'.activo',true)
                    ->select($request->modulo.'.*', 'niveles_riesgo.llave', 'niveles_riesgo.valor')
                    ->get();

            }catch(Exception $e){
                dd($e);
            }

            return $registros;

        }
    }

    // Consultar registro Ajax
    public function consultarAjax($modulo, $id)
    {  
        try{

            $registro = DB::table($modulo)->where('id', $id)->first();  

        }catch(Exception $e){
            dd($e);
        }

        return response()->json($registro);
    }

}
