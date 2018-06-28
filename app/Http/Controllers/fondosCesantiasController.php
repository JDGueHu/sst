<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FondosCesantias;

class fondosCesantiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fondos_cesantias = FondosCesantias::orderBy('llave', 'asc')->get();
        return view('administracion.listas_desplegables.fondos_cesantias.index')
            ->with('fondos_cesantias',$fondos_cesantias);
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
        $fondos_cesantias = FondosCesantias::where('llave','=', $request->llave)->get();

        if ($fondos_cesantias->count() == 0) {
            $registro_duplicado = 0;       
        }

        return $registro_duplicado;
    }

    // Creación de fonde de cesantías ajax
    public function crearAjax(Request $request)
    {
        if($request->ajax()){      

            try{

                $fondo_cesantias = new FondosCesantias();
                $fondo_cesantias->llave = $request->llave;
                $fondo_cesantias->valor = $request->valor;
                $fondo_cesantias->save();

            }catch(Exception $e){
                dd($e);
            }

            return $fondo_cesantias;

        }
    }

    // Eliminar fonde de cesantías ajax
    public function eliminarAjax($id)
    {
    
        try{
            $fondo_cesantias = FondosCesantias::find($id);
            $fondo_cesantias->delete();

        }catch(Exception $e){
            dd($e);
        }

    }
    
}
