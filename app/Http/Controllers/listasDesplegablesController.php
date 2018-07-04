<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class listasDesplegablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion.listas_desplegables.index');
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
            $registro = DB::table($request->modulo)->where('llave', '=', $request->llave)->get();

            if ($registro->count() == 0) {
                $duplicado = 0;       
            }

            return $duplicado;

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

    // Creación de del nuevo registro Ajax
    public function crearAjax(Request $request)
    {
        if($request->ajax()){      
            
            try{

                // Se crea el registro en la tabla sin tener en cuenta aun si es la opción 
                // por defecto
                $registro = DB::table($request->modulo)->insert(
                    [
                    'llave' => $request->llave,
                    'valor' => $request->valor
                    ]
                );

                // Si el registro viene marcado como opción por defecto se procede a 
                // gestionar la marcación del nuevo y del anterior registro
                if($request->valor_por_defecto == 'true'){

                    // Se busca el registro marcado por defecto
                    $registro_por_defecto = DB::table($request->modulo)->where('valor_por_defecto', '<>', null)->get();

                    // Se le quita al registro actual la opción por defecto
                    if($registro_por_defecto->count() > 0){
                        
                        DB::table($request->modulo)
                            ->where('id', '=', $registro_por_defecto[0]->id)
                            ->update(['valor_por_defecto' => null]);

                    }

                    $registro = DB::table($request->modulo)->where('llave', '=', $request->llave)->get();

                    DB::table($request->modulo)
                        ->where('id', '=', $registro[0]->id)
                        ->update(['valor_por_defecto' => $request->llave]);
                    
                }

                $registros = DB::table($request->modulo)
                                    ->orderBy('llave', 'asc')->get();

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

            DB::table($modulo)->where('id', '=', $id)->delete();

        }catch(Exception $e){
            dd($e);
        }
    }
}
