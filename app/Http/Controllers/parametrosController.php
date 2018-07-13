<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class parametrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion.parametros.index');
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

                // Se crea el registro en la tabla
                $registro = DB::table($request->modulo)->insert(
                    [
                    'codigo' => $request->codigo,
                    'nombre' => $request->nombre,
                    'nivel_riesgo_id' => $request->nivel_riesgo_id
                    ]
                );

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

    // Modificación de registro Ajax
    public function editarAjax(Request $request)
    {
        if($request->ajax()){      
            
            try{

                DB::table($request->modulo)
                    ->where('codigo', '=', $request->codigo)
                    ->where('activo', true)
                    ->update([
                        'codigo' => $request->codigo,
                        'nombre' => $request->nombre,
                        'nivel_riesgo_id' => $request->nivel_riesgo_id                 
                    ]);
                
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

    // Eliminación de regsitro Ajax
    public function eliminarAjax($modulo,$id)
    {  
        try{

            DB::table($modulo)
                ->where('id', '=', $id)
                ->update([
                    'activo' => false             
            ]);

        }catch(Exception $e){
            dd($e);
        }
    }

}
