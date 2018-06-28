<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EPS;

class epsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $epss = EPS::orderBy('llave', 'asc')->get();
        return view('administracion.listas_desplegables.epss.index')
            ->with('epss',$epss);
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
        $epss = EPS::where('llave','=', $request->llave)->get();

        if ($epss->count() == 0) {
            $registro_duplicado = 0;       
        }

        return $registro_duplicado;
    }

    // Creación de EPS ajax
    public function crearAjax(Request $request)
    {
        if($request->ajax()){      

            try{

                $eps = new EPS();
                $eps->llave = $request->llave;
                $eps->valor = $request->valor;
                $eps->save();

            }catch(Exception $e){
                dd($e);
            }

            return $eps;

        }
    }

    // Eliminar EPS ajax
    public function eliminarAjax($id)
    {
    
        try{
            $eps = EPS::find($id);
            $eps->delete();

        }catch(Exception $e){
            dd($e);
        }

    }
}
