@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item color_breadcrum_href"><a href="{{ route('empleados.index') }}">Empleados</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
</ol>
</nav>

{!! Form::open(['route' => 'empleados.store', 'method' => 'POST', 'id' => 'example_form', 'files' => true]) !!}

<!-- 'enctype' => 'multipart/form-data'-->
<a style="text-decoration: none;">
    {!! Form::button('Guardar',['class' => 'btn btn-primary separar_boton guardar'])  !!}
</a>
<a style="text-decoration: none;" href="{{ route('empleados.index') }}">
    {!! Form::button('Regresar',['class' => 'btn btn-default separar_boton '])  !!}
</a>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
        Datos personales &nbsp; <span class="badge badge-danger"  id="error_nav-tab"></span>
    </a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
        Datos de contacto &nbsp; <span class="badge badge-danger"  id="error_nav-profile"></span>
    </a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
        Datos laborales &nbsp; <span class="badge badge-danger"  id="error_nav-contact"></span>
    </a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

    <div class="row">
      <div class="col-md-3 separar_input_top">
          {!! Form::label('tipo_identificacion_id','Tipo identificación')  !!}
          {!! Form::select('tipo_identificacion_id', $tipos_identificacion, $tipo_identificacion_default, ['class' => 'form-control', 'placeholder' => 'Seleccione tipo identificación','id'=>'tipo_identificacion_id'])  !!} 
          
          {!! Form::label('tipo_identificacion_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_tipo_identificacion_id']) !!}
            @if ($errors->has('tipo_identificacion_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('tipo_identificacion_id') }}</span>
                </span>
            @endif
      </div>
      <div class="col-md-3 separar_input_top">
          {!! Form::label('identificacion','Número de identificación')  !!}
          {!! Form::text('identificacion',null, ['class' => 'form-control', 'id'=>'identificacion'])  !!}

          {!! Form::label('identificacion', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_identificacion']) !!}
            @if ($errors->has('identificacion'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('identificacion') }}</span>
                </span>
            @endif
      </div>    
      <div class="col-md-3 separar_input_top">
          {!! Form::label('nombres','Nombres')  !!}
          {!! Form::text('nombres',null, ['class' => 'form-control', 'id'=>'nombres'])  !!}

          {!! Form::label('nombres', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_nombres']) !!}
            @if ($errors->has('nombres'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('nombres') }}</span>
                </span>
            @endif
      </div>
      <div class="col-md-3 separar_input_top">
          {!! Form::label('apellidos','Apellidos')  !!}
          {!! Form::text('apellidos',null, ['class' => 'form-control', 'id'=>'apellidos'])  !!}
    
          {!! Form::label('apellidos', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_apellidos']) !!}
            @if ($errors->has('apellidos'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('apellidos') }}</span>
                </span>
            @endif
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 separar_input_top">
          {!! Form::label('genero_id','Género')  !!}
          {!! Form::select('genero_id', $generos, $generos_default, ['class' => 'form-control', 'placeholder' => 'Seleccione genero','id'=>'genero_id'])  !!} 

          {!! Form::label('genero_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_genero_id']) !!}
            @if ($errors->has('genero_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('genero_id') }}</span>
                </span>
            @endif
      </div>  
      <div class="col-md-3 separar_input_top">
          {!! Form::label('grupo_sanguineo_id','Grupo sanguíneo y Factor RH')  !!}
          {!! Form::select('grupo_sanguineo_id', $grupos_sanguineos, $grupos_sanguineos_default, ['class' => 'form-control', 'placeholder' => 'Seleccione grupo sanguíneo','id'=>'grupo_sanguineo_id'])  !!} 
      
          {!! Form::label('grupo_sanguineo_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_grupo_sanguineo_id']) !!}
            @if ($errors->has('grupo_sanguineo_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('grupo_sanguineo_id') }}</span>
                </span>
            @endif
      </div>  
      <div class="col-md-3 separar_input_top">
          
          {!! Form::label('fecha_nacimiento','Fecha de nacimiento')  !!}
          {!! Form::text('fecha_nacimiento',null, ['class' => 'form-control fecha', 'id'=>'fecha_nacimiento'])  !!}
          
          {!! Form::label('fecha_nacimiento', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_fecha_nacimiento']) !!}
            @if ($errors->has('fecha_nacimiento'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('fecha_nacimiento') }}</span>
                </span>
            @endif
      </div>
      <div class="col-md-3 separar_input_top">
          {!! Form::label('edad','Edad (Años)')  !!}
          {!! Form::number('edad',null, ['class' => 'form-control', 'id'=>'edad', 'readonly'])  !!}
      </div>
    </div>

    <div class="row">
        <div class="col-md-3 separar_input_top">
            {!! Form::label('ciudad_nacimiento','Ciudad de nacimiento')  !!}
            {!! Form::text('ciudad_nacimiento',null, ['class' => 'form-control', 'id'=>'ciudad_nacimiento', 'onFocus'=>'geolocate()'])  !!}
        
            {!! Form::label('ciudad_nacimiento', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_ciudad_nacimiento']) !!}
            @if ($errors->has('ciudad_nacimiento'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('ciudad_nacimiento') }}</span>
                </span>
            @endif
        </div>  
        <div class="col-md-3 separar_input_top">
            {!! Form::label('departamento_nacimiento','Departamento de nacimiento')  !!}
            {!! Form::text('departamento_nacimiento',null, ['class' => 'form-control','id'=>'departamento_nacimiento','readonly'])  !!}
        </div>  
        <div class="col-md-3 separar_input_top">
            {!! Form::label('pais_nacimiento','País de nacimiento')  !!}
            {!! Form::text('pais_nacimiento',null, ['class' => 'form-control', 'id'=>'pais_nacimiento','readonly'])  !!}
        </div>
        <div class="col-md-3 separar_input_top">
            {!! Form::label('estado_civil_id','Estado civil')  !!}
            {!! Form::select('estado_civil_id', $estados_civiles, $estados_civiles_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione estado civil','id'=>'estado_civil_id'])  !!} 
        
            {!! Form::label('estado_civil_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_estado_civil_id']) !!}
            @if ($errors->has('estado_civil_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('estado_civil_id') }}</span>
                </span>
            @endif
        </div> 
    </div>

    <div class="row">
        <div class="col-md-3 separar_input_top">
            {!! Form::label('numero_hijos','Número de hijos')  !!}
            {!! Form::number('numero_hijos',0, ['class' => 'form-control', 'id'=>'numero_hijos'])  !!}
        </div>
        <div class="col-md-3 separar_input_top">
            {!! Form::label('foto','Foto')  !!}
            {!! Form::file('foto', ['class' => 'form-control', 'id'=>'foto'])  !!}
        </div>   
    </div>

  </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  
    <div class="row">
        <div class="col-md-3 separar_input_top">
            {!! Form::label('ciudad_direccion','Ciudad de residencia')  !!}
            {!! Form::text('ciudad_direccion',null, ['class' => 'form-control', 'required', 'id'=>'ciudad_direccion', 'onFocus'=>'geolocate()'])  !!}
        
            {!! Form::label('ciudad_direccion', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_ciudad_direccion']) !!}
            @if ($errors->has('ciudad_direccion'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('ciudad_direccion') }}</span>
                </span>
            @endif
        </div>
        <div class="col-md-3 separar_input_top">
            {!! Form::label('departamento_direccion','Departamento de residencia')  !!}
            {!! Form::text('departamento_direccion',null, ['class' => 'form-control', 'id'=>'departamento_direccion','readonly'])  !!}
        </div>    
        <div class="col-md-3 separar_input_top">
            {!! Form::label('pais_direccion','Pais de residencia')  !!}
            {!! Form::text('pais_direccion',null, ['class' => 'form-control', 'id'=>'pais_direccion','readonly'])  !!}
        </div>  
        <div class="col-md-3 separar_input_top">
            {!! Form::label('direccion','Dirección de residencia')  !!}
            {!! Form::text('direccion',null, ['class' => 'form-control', 'required', 'id'=>'direccion'])  !!}
        
            {!! Form::label('direccion', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_direccion']) !!}
            @if ($errors->has('direccion'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('direccion') }}</span>
                </span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 separar_input_top">
            {!! Form::label('email_personal','Correo electrónico personal')  !!}
            {!! Form::email('email_personal',null, ['class' => 'form-control', 'required', 'id'=>'email_personal'])  !!}
        
            {!! Form::label('email_personal', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_email_personal']) !!}
            @if ($errors->has('email_personal'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('email_personal') }}</span>
                </span>
            @endif
        </div>
        <div class="col-md-3 separar_input_top">
            {!! Form::label('telefono_fijo','Teléfono fijo')  !!}
            {!! Form::text('telefono_fijo',null, ['class' => 'form-control', 'id'=>'telefono_fijo'])  !!}
        </div>    
        <div class="col-md-3 separar_input_top">
            {!! Form::label('telefono_celular','Celular')  !!}
            {!! Form::text('telefono_celular',null, ['class' => 'form-control', 'id'=>'telefono_celular'])  !!}
        
            {!! Form::label('telefono_celular', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_telefono_celular']) !!}
            @if ($errors->has('telefono_celular'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('telefono_celular') }}</span>
                </span>
            @endif
        </div>  
    </div>

  </div>
  
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    
    <div class="row">
        <div class="col-md-3 separar_input_top">
            {!! Form::label('email_corporativo','Email corporativo')  !!}
            {!! Form::email('email_corporativo',null, ['class' => 'form-control', 'id'=>'email_corporativo'])  !!}
       
            @if ($errors->has('email_corporativo'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('email_corporativo') }}</span>
                </span>
            @endif
        </div>  
        <div class="col-md-3 separar_input_top">
            {!! Form::label('eps_id','EPS')  !!}
            {!! Form::select('eps_id', $eps, $eps_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione una EPS','id'=>'eps_id'])  !!} 
        
            {!! Form::label('eps_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_eps_id']) !!}
            @if ($errors->has('eps_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('eps_id') }}</span>
                </span>
            @endif
        </div>   
        <div class="col-md-3 separar_input_top">
            {!! Form::label('arl_id','ARL')  !!}
            {!! Form::select('arl_id', $arl, $arl_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione una ARL','id'=>'arl_id'])  !!} 
        
            {!! Form::label('arl_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_arl_id']) !!}
            @if ($errors->has('arl_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('arl_id') }}</span>
                </span>
            @endif
        </div>  
        <div class="col-md-3 separar_input_top">
            {!! Form::label('fondo_cesantias_id','Fondo de cesantías')  !!}
            {!! Form::select('fondo_cesantias_id', $fondos_cesantias, $fondos_cesantias_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un fondo','id'=>'fondo_cesantias_id'])  !!} 
        
            {!! Form::label('fondo_cesantias_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_fondo_cesantias_id']) !!}
            @if ($errors->has('fondo_cesantias_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('fondo_cesantias_id') }}</span>
                </span>
            @endif
        </div> 
    </div>

    <div class="row">
        <div class="col-md-3 separar_input_top">
            {!! Form::label('fondo_pensiones_id','Fondo de pensiones')  !!}
            {!! Form::select('fondo_pensiones_id', $fondos_pensiones, $fondos_pensiones_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un fondo','id'=>'fondo_pensiones_id'])  !!} 
        
            {!! Form::label('fondo_pensiones_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_fondo_pensiones_id']) !!}
            @if ($errors->has('fondo_pensiones_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('fondo_pensiones_id') }}</span>
                </span>
            @endif
        </div>
        <div class="col-md-3 separar_input_top">
            {!! Form::label('area_id','Área')  !!}
            {!! Form::select('area_id', $areas, $areas_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un área','id'=>'area_id'])  !!} 
        
            {!! Form::label('area_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_area_id']) !!}
            @if ($errors->has('area_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('area_id') }}</span>
                </span>
            @endif
        </div> 
        <div class="col-md-3 separar_input_top">
            {!! Form::label('centro_trabajo_id','Centro de trabajo')  !!}
            {!! Form::select('centro_trabajo_id', $centros_trabajo, null, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione centro trabajo','id'=>'centro_trabajo_id'])  !!} 
        
            {!! Form::label('centro_trabajo_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_centro_trabajo_id']) !!}
            @if ($errors->has('centro_trabajo_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('centro_trabajo_id') }}</span>
                </span>
            @endif
        </div> 
        <div class="col-md-3 separar_input_top">
            {!! Form::label('nombre_riesgo_centro_trabajo','Nivel de riesgo (Centro de trabajo)')  !!}
            {!! Form::text('nombre_riesgo_centro_trabajo',null, ['class' => 'form-control', 'id'=>'nombre_riesgo_centro_trabajo','readonly'])  !!}
        </div> 
    </div>

    <div class="row">
        <div class="col-md-3 separar_input_top">
            {!! Form::label('riesgo_centro_trabajo','Valor del riesgo (Centro de trabajo)')  !!}
            {!! Form::text('riesgo_centro_trabajo',null, ['class' => 'form-control', 'id'=>'riesgo_centro_trabajo','readonly'])  !!}
        </div>
        <div class="col-md-3 separar_input_top">
            {!! Form::label('cargo_id','Cargo')  !!}
            {!! Form::select('cargo_id', $cargos, null, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un cargo','id'=>'cargo_id'])  !!} 
        
            {!! Form::label('cargo_id', 'Campo requerido', ['class' => 'validar_campo','id'=>'error_cargo_id']) !!}
            @if ($errors->has('cargo_id'))
                <span style="color: red" class="help-block">
                    <span>{{ $errors->first('cargo_id') }}</span>
                </span>
            @endif
        </div>
        <div class="col-md-3 separar_input_top">
            {!! Form::label('nombre_riesgo_cargo','Nivel de riesgo (Cargo)')  !!}
            {!! Form::text('nombre_riesgo_cargo',null, ['class' => 'form-control', 'id'=>'nombre_riesgo_cargo','readonly'])  !!}
        </div>
        <div class="col-md-3 separar_input_top">
            {!! Form::label('riesgo_cargo','Valor del riesgo (Cargo)')  !!}
            {!! Form::text('riesgo_cargo',null, ['class' => 'form-control', 'id'=>'riesgo_cargo','readonly'])  !!}
        </div> 
    </div>

    <div class="row">
        <div class="col-md-3 separar_input_top">
            {!! Form::label('riesgo_total','Riesgo total')  !!}
            {!! Form::text('riesgo_total',null, ['class' => 'form-control', 'id'=>'riesgo_total','readonly'])  !!}
        </div>
    </div>

  </div>

</div>

<!-- {!! Form::submit('Guardar',['class' => 'btn btn-primary separar_top '])  !!} -->
<a style="text-decoration: none;">
    {!! Form::button('Guardar',['class' => 'btn btn-primary separar_top separar_boton guardar'])  !!}
</a>
<a style="text-decoration: none;" href="{{ route('empleados.index') }}">
    {!! Form::button('Regresar',['class' => 'btn btn-default separar_top separar_boton'])  !!}
</a>

{!! Form::close() !!}

@endsection

@section('js')
    <script src="{{ asset('js/compartido.js') }}"></script>
    <script src="{{ asset('js/empleados/compartido.js') }}"></script>
    <script src="{{ asset('js/empleados/create.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMeUNAUOMCxF32rNqvTs7p9rV9DXFiiaw&libraries=places&callback=initAutocomplete"
        async defer></script>

    <script>
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('.fecha').datepicker({
            uiLibrary: 'bootstrap4',
            icons: {
                rightIcon: '<i class="far fa-calendar-alt"></i>'
            },
            locale: 'es-es',
            header: true,
            maxDate: today
        });
    </script>

@endsection