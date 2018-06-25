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
        $arls = ARL::get();
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
                $arl->save();

            }catch(Exception $e){
                dd($e);
            }

            return $arl;

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
