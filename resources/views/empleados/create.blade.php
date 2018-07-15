@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item color_breadcrum_href"><a href="{{ route('empleados.index') }}">Empleados</a></li>
    <li class="breadcrumb-item active" aria-current="page">Crear</li>
</ol>
</nav>

{!! Form::open(['route' => 'empleados.store', 'method' => 'POST', 'id' => 'example-form']) !!}

{!! Form::submit('Guardar',['class' => 'btn btn-primary separar_boton '])  !!}
<a style="text-decoration: none;" href="{{ route('empleados.index') }}">
    {!! Form::button('Regresar',['class' => 'btn btn-default separar_boton '])  !!}
</a>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Datos personales</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Datos de contacto</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Datos laborales</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

    <div class="row">
      <div class="col-md-3 separar_input_top">
          {!! Form::label('tipo_identificacion_id','Tipo identificación')  !!}
          {!! Form::select('tipo_identificacion_id', $tipos_identificacion, $tipo_identificacion_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un tipo de identificación','id'=>'tipo_identificacion_id'])  !!} 
      </div>
      <div class="col-md-3 separar_input_top">
          {!! Form::label('identificacion','Número de identidad')  !!}
          {!! Form::text('identificacion',null, ['class' => 'form-control', 'required', 'id'=>'identificacion'])  !!}
      </div>    
      <div class="col-md-3 separar_input_top">
          {!! Form::label('nombres','Nombres')  !!}
          {!! Form::text('nombres',null, ['class' => 'form-control', 'required', 'id'=>'nombres'])  !!}
      </div>
      <div class="col-md-3 separar_input_top">
          {!! Form::label('apellidos','Apellidos')  !!}
          {!! Form::text('apellidos',null, ['class' => 'form-control', 'required', 'id'=>'apellidos'])  !!}
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 separar_input_top">
          {!! Form::label('genero_id','Género')  !!}
          {!! Form::select('genero_id', $generos, $generos_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un genero','id'=>'genero_id'])  !!} 
      </div>  
      <div class="col-md-3 separar_input_top">
          {!! Form::label('grupo_sanguineo_id','Grupo sanguíneo y Factor RH')  !!}
          {!! Form::select('grupo_sanguineo_id', $grupos_sanguineos, $grupos_sanguineos_default, ['class' => 'form-control', 'required', 'placeholder' => 'Seleccione un grupo sanguíneo','id'=>'grupo_sanguineo_id'])  !!} 
      </div>  
      <div class="col-md-3 separar_input_top">
          {!! Form::label('fecha_nacimiento','Fecha de nacimiento')  !!}
          {!! Form::date('fecha_nacimiento',null, ['class' => 'form-control', 'required', 'id'=>'fecha_nacimiento'])  !!}
      </div>
      <div class="col-md-3 separar_input_top">
          {!! Form::label('edad','Edad (Años)')  !!}
          {!! Form::number('edad',null, ['class' => 'form-control', 'id'=>'edad', 'readonly'])  !!}
      </div>
    </div>
    
  </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>

</div>

{!! Form::submit('Guardar',['class' => 'btn btn-primary separar_top '])  !!}
<a style="text-decoration: none;" href="{{ route('empleados.index') }}">
    {!! Form::button('Regresar',['class' => 'btn btn-default separar_top '])  !!}
</a>

{!! Form::close() !!}

@endsection

