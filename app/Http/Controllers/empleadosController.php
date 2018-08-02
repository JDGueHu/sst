<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Empleado;
use App\TipoIdentificacion;
use App\Genero;
use App\GrupoSanguineo;
use App\EstadoCivil;
use App\Area;
use App\Cargo;
use App\EPS;
use App\ARL;
use App\FondosCesantias;
use App\FondoPensiones;
use App\CentroTrabajo;

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
        //Tipos de identificación
        $tipos_identificacion = TipoIdentificacion::where('activo',true)->pluck('valor','id');
        $tipo_identificacion_default = TipoIdentificacion::whereNotNull('valor_por_defecto')->first();
        if($tipo_identificacion_default != null){$tipo_identificacion_default = $tipo_identificacion_default->id;}

        //Géneros
        $generos = Genero::where('activo',true)->pluck('valor','id');
        $generos_default = Genero::whereNotNull('valor_por_defecto')->first();
        if($generos_default != null){$generos_default = $generos_default->id;}

        //Grupos sangúineos
        $grupos_sanguineos = GrupoSanguineo::where('activo',true)->pluck('valor','id');
        $grupos_sanguineos_default = GrupoSanguineo::whereNotNull('valor_por_defecto')->first();
        if($grupos_sanguineos_default != null){$grupos_sanguineos_default = $grupos_sanguineos_default->id;}

        //Estados civiles
        $estados_civiles = EstadoCivil::where('activo',true)->pluck('valor','id');
        $estados_civiles_default = EstadoCivil::whereNotNull('valor_por_defecto')->first();
        if($estados_civiles_default != null){$estados_civiles_default = $estados_civiles_default->id;}

        //EPS
        $eps = EPS::where('activo',true)->pluck('valor','id');
        $eps_default = EPS::whereNotNull('valor_por_defecto')->first();
        if($eps_default != null){$eps_default = $eps_default->id;}

        //ARL
        $arl = ARL::where('activo',true)->pluck('valor','id');
        $arl_default = ARL::whereNotNull('valor_por_defecto')->first();
        if($arl_default != null){$arl_default = $arl_default->id;}

        //Fondo de cesantías
        $fondos_cesantias = FondosCesantias::where('activo',true)->pluck('valor','id');
        $fondos_cesantias_default = FondosCesantias::whereNotNull('valor_por_defecto')->first();
        if($fondos_cesantias_default != null){$fondos_cesantias_default = $fondos_cesantias_default->id;}

        //Fondo de pensiones
        $fondos_pensiones = FondosCesantias::where('activo',true)->pluck('valor','id');
        $fondos_pensiones_default = FondosCesantias::whereNotNull('valor_por_defecto')->first();
        if($fondos_pensiones_default != null){$fondos_pensiones_default = $fondos_pensiones_default->id;}

        //Áreas
        $areas = Area::where('activo',true)->pluck('valor','id');
        $areas_default = Area::whereNotNull('valor_por_defecto')->first();
        if($areas_default != null){$areas_default = $areas_default->id;}

        //Centros de trabajo
        $centros_trabajo = CentroTrabajo::where('activo',true)->pluck('nombre','id');        

        //Cargos
        $cargos = Cargo::where('activo',true)->pluck('nombre','id'); 

        return view('empleados.create')
            ->with('tipos_identificacion',$tipos_identificacion)
            ->with('tipo_identificacion_default',$tipo_identificacion_default)
            ->with('generos',$generos)
            ->with('generos_default',$generos_default)
            ->with('grupos_sanguineos',$grupos_sanguineos)
            ->with('grupos_sanguineos_default',$grupos_sanguineos_default)
            ->with('estados_civiles',$estados_civiles)
            ->with('estados_civiles_default',$estados_civiles_default)
            ->with('eps',$eps)
            ->with('eps_default',$eps_default)
            ->with('arl',$arl)
            ->with('arl_default',$arl_default)
            ->with('fondos_cesantias',$fondos_cesantias)
            ->with('fondos_cesantias_default',$fondos_cesantias_default)
            ->with('fondos_pensiones',$fondos_pensiones)
            ->with('fondos_pensiones_default',$fondos_pensiones_default)
            ->with('areas',$areas)
            ->with('areas_default',$areas_default)
            ->with('cargos',$cargos)
            ->with('centros_trabajo',$centros_trabajo);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tipo_identificacion_id' => 'required',
            'identificacion' => 'required|unique:empleados',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'genero_id' => 'required',
            'grupo_sanguineo_id' => 'required',
            'fecha_nacimiento' => 'required',
            'ciudad_nacimiento' => 'required',
            'departamento_nacimiento' => 'required',
            'pais_nacimiento' => 'required',
            'estado_civil_id' => 'required',
            'ciudad_direccion' => 'required',
            'departamento_direccion' => 'required',
            'pais_direccion' => 'required',
            'direccion' => 'required|max:200',
            'email_personal' => 'required|email',
            'telefono_celular' => 'required|string',
            'eps_id' => 'required',
            'arl_id' => 'required',
            'fondo_cesantias_id' => 'required',
            'fondo_pensiones_id' => 'required',
            'cargo_id' => 'required',
            'area_id' => 'required',
            'centro_trabajo_id' => 'required',
            'estado' => 'required|string',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validator($request->all())->validate();

            $empleado = new Empleado();
        }
        catch(Exception $e){
            dd($e);
        }
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
