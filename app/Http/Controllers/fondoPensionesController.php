<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FondoPensiones;

class fondoPensionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fondos_pensiones = FondoPensiones::orderBy('llave', 'asc')->get();
        return view('administracion.listas_desplegables.fondos_pensiones.index')
            ->with('fondos_pensiones',$fondos_pensiones);
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

    // Consultar un fondo de pensiones ajax
    public function consultarAjax($id)
    {  
        try{
            $fondo_pensiones = FondoPensiones::find($id);            
        }catch(Exception $e){
            dd($e);
        }

        return $fondo_pensiones;
    }

    public function validarDuplicado(Request $request)
    {
        $registro_duplicado = 1;
        $fondos_pensiones = FondoPensiones::where('llave','=', $request->llave)->get();

        if ($fondos_pensiones->count() == 0) {
            $registro_duplicado = 0;       
        }

        return $registro_duplicado;
    }

    // Creación de fondo de pensiones ajax
    public function crearAjax(Request $request)
    {
        if($request->ajax()){      

            try{

                $fondo_pensiones = new FondoPensiones();
                $fondo_pensiones->llave = $request->llave;
                $fondo_pensiones->valor = $request->valor;

                if($request->valor_por_defecto == 'true'){
                    $fondo_pensiones_old = FondoPensiones::whereNotNull('valor_por_defecto')->first();

                    if($fondo_pensiones_old != null){
                        $fondo_pensiones_old->valor_por_defecto = null;
                        $fondo_pensiones_old->save();
                    }

                    $fondo_pensiones->valor_por_defecto = $request->llave;
                }
                
                $fondo_pensiones->save();

                $fondos_pensiones = FondoPensiones::orderBy('llave', 'asc')->get();

            }catch(Exception $e){
                dd($e);
            }

            return $fondos_pensiones;

        }
    }

    // Modificación de fonde de pensiones ajax
    public function editarAjax(Request $request)
    {
        if($request->ajax()){      
            
            try{

                $fondo_pensiones = FondoPensiones::where('llave', '=', $request->llave)->first();

                if($request->valor_por_defecto == 'true'){
                    
                    $fondo_pensiones_old = FondoPensiones::whereNotNull('valor_por_defecto')->first();

                    if($fondo_pensiones_old != null){
                        $fondo_pensiones_old->valor_por_defecto = null;
                        $fondo_pensiones_old->save();
                    }

                    $fondo_pensiones->llave = $request->llave;
                    $fondo_pensiones->valor = $request->valor;
                    $fondo_pensiones->valor_por_defecto = $request->llave;

                }else{
                    
                    $fondo_pensiones->llave = $request->llave;
                    $fondo_pensiones->valor = $request->valor;
                    $fondo_pensiones->valor_por_defecto = null;

                }
                
                $fondo_pensiones->save();

                $fondos_pensiones = FondoPensiones::orderBy('llave', 'asc')->get();

            }catch(Exception $e){
                dd($e);
            }

            return $fondos_pensiones;

        }
    }

    // Eliminar fondo de pensiones ajax
    public function eliminarAjax($id)
    {
    
        try{
            $fondo_pensiones = FondoPensiones::find($id);
            $fondo_pensiones->delete();

        }catch(Exception $e){
            dd($e);
        }

    }

}
