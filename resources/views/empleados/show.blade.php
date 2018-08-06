@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item color_breadcrum_href"><a href="{{ route('empleados.index') }}">Empleados</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detalles</li>
</ol>
</nav>

<a style="text-decoration: none;" href="{{ route('empleados.index') }}">
    {!! Form::button('Regresar',['class' => 'btn btn-default separar_boton '])  !!}
</a>

{!! Form::model($empleado) !!}

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
            <img src="{{ $empleado->foto }}" height="200" width="200" class="rounded border border-primary">
        </div>
        <div class="col-md-3 separar_input_top">
            <div class="short-div">
                <b>{!! Form::label(null,'Tipo de identificación', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,$empleado->tipoIdentificacion->valor, ['class'=>'d-block'])  !!}
            </div>
            <div class="short-div">
                <b>{!! Form::label(null,'Apellidos', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,$empleado->apellidos, ['class'=>'d-block'])  !!}
            </div>
            <div class="short-div">
                <b>{!! Form::label(null,'Fecha de nacimiento', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,$empleado->fecha_nacimiento, ['class'=>'d-block'])  !!}
                <input type="hidden" id="fecha_nacimiento"  value="{{ $empleado->fecha_nacimiento }}">
            </div>
        </div>
        <div class="col-md-3 separar_input_top">
            <div class="short-div">
                <b>{!! Form::label(null,'Identificación', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,$empleado->identificacion, ['class'=>'d-block'])  !!}
            </div>
            <div class="short-div">
                <b>{!! Form::label(null,'Género', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,$empleado->genero->valor, ['class'=>'d-block'])  !!}
            </div>
            <div class="short-div">
                <b>{!! Form::label(null,'Edad', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,null, ['class'=>'d-block', 'id' => 'edad'])  !!}
            </div>
        </div>
        <div class="col-md-3 separar_input_top">
            <div class="short-div">
                <b>{!! Form::label(null,'Nombres', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,$empleado->nombres, ['class'=>'d-block'])  !!}
            </div>
            <div class="short-div">
                <b>{!! Form::label(null,'Grupo sanguíneo y Factor RH', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,$empleado->grupoSanguineo->valor, ['class'=>'d-block'])  !!}
            </div>
            <div class="short-div">
                <b>{!! Form::label(null,'Ciudad de nacimiento', ['class'=>'d-block'])  !!}</b>
                {!! Form::label(null,$empleado->ciudad_nacimiento, ['class'=>'d-block'])  !!}
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-3 separar_input_top">
            <b>{!! Form::label(null,'Departamento de nacimiento', ['class'=>'d-block'])  !!}</b>
            {!! Form::label(null,$empleado->departamento_nacimiento, ['class'=>'d-block'])  !!}
        </div>
        <div class="col-md-3 separar_input_top">
            <b>{!! Form::label(null,'País de nacimiento', ['class'=>'d-block'])  !!}</b>
            {!! Form::label(null,$empleado->pais_nacimiento, ['class'=>'d-block'])  !!}
        </div>
        <div class="col-md-3 separar_input_top">
            <b>{!! Form::label(null,'Estado civil', ['class'=>'d-block'])  !!}</b>
            {!! Form::label(null,$empleado->estadoCivil->valor, ['class'=>'d-block'])  !!}
        </div>
        <div class="col-md-3 separar_input_top">
            <b>{!! Form::label(null,'Número de hijos', ['class'=>'d-block'])  !!}</b>
            @if($empleado->numero_hijos == 0)
            {!! Form::label(null,'Ninguno', ['class'=>'d-block'])  !!}
            @else
            {!! Form::label(null,$empleado->numero_hijos, ['class'=>'d-block'])  !!}
            @endif 
        </div>
    </div>
  
  </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      
  </div>

  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
      
  </div>
</div>

{!! Form::close() !!}

<a style="text-decoration: none;" href="{{ route('empleados.index') }}">
    {!! Form::button('Regresar',['class' => 'btn btn-default separar_top separar_boton'])  !!}
</a>

@endsection

@section('js')
    <script src="{{ asset('js/empleados/compartido.js') }}"></script>
@endsection