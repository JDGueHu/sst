<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ARL;

class arlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arls = ARL::orderBy('llave', 'asc')->get();
        return view('administracion.listas_desplegables.arls.index')
            ->with('arls',$arls);
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

    // Consultar una ARL ajax
    public function consultarAjax($id)
    {  
        try{
            $arl = ARL::find($id);            
        }catch(Exception $e){
            dd($e);
        }

        return $arl;
    }

    public function validarDuplicado(Request $request)
    {
        $registro_duplicado = 1;
        $arls = ARL::where('llave','=', $request->llave)->get();

        if ($arls->count() == 0) {
            $registro_duplicado = 0;       
        }

        return $registro_duplicado;
    }

    // Creación de ARL ajax
    public function crearAjax(Request $request)
    {
        if($request->ajax()){      
            
            try{

                $arl = new ARL();
                $arl->llave = $request->llave;
                $arl->valor = $request->valor;

                if($request->valor_por_defecto == 'true'){
                    $arl_old = ARL::whereNotNull('valor_por_defecto')->first();

                    if($arl_old != null){
                        $arl_old->valor_por_defecto = null;
                        $arl_old->save();
                    }

                    $arl->valor_por_defecto = $request->llave;
                }
                
                $arl->save();

                $arls = ARL::orderBy('llave', 'asc')->get();

            }catch(Exception $e){
                dd($e);
            }

            return $arls;

        }
    }

    // Modificación de ARL ajax
    public function editarAjax(Request $request)
    {
        if($request->ajax()){      
            
            try{

                $arl = ARL::where('llave', '=', $request->llave)->first();

                if($request->valor_por_defecto == 'true'){
                    
                    $arl_old = ARL::whereNotNull('valor_por_defecto')->first();

                    if($arl_old != null){
                        $arl_old->valor_por_defecto = null;
                        $arl_old->save();
                    }

                    $arl->llave = $request->llave;
                    $arl->valor = $request->valor;
                    $arl->valor_por_defecto = $request->llave;

                }else{
                    
                    $arl->llave = $request->llave;
                    $arl->valor = $request->valor;
                    $arl->valor_por_defecto = null;

                }
                
                $arl->save();

                $arls = ARL::orderBy('llave', 'asc')->get();

            }catch(Exception $e){
                dd($e);
            }

            return $arls;

        }
    }

    // Eliminar ARL ajax
    public function eliminarAjax($id)
    {  
        try{
            $arl = ARL::find($id);
            $arl->delete();

        }catch(Exception $e){
            dd($e);
        }
    }
}
