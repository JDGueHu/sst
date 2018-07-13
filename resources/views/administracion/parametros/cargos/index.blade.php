@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item color_breadcrum_href"><a href="{{ route('parametros.index') }}">Parámetros</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cargos</li>
</ol>
</nav>

<div class="row separar_boton">   
    <div class="col-md-3">
      {!! Form::text('codigo',null, ['class' => 'form-control', 'id'=>'codigo', 'placeholder'=>'Código'])  !!}
      {!! Form::label('codigo', 'Ingrese un código válido', ['class' => 'validar_campo','id'=>'error_codigo']) !!}
    </div>
    <div class="col-md-3">
      {!! Form::text('nombre',null, ['class' => 'form-control', 'id'=>'nombre', 'placeholder'=>'Nombre'])  !!}
      {!! Form::label('nombre', 'Ingrese un nombre válido', ['class' => 'validar_campo','id'=>'error_nombre']) !!}
    </div>
    <div class="col-md-3">
      {!! Form::select('nivel_riesgo', $niveles_riesgo, $nivel_riesgo_default,['class' => 'form-control', 'id'=>'nivel_riesgo_id', 'placeholder' => 'Nivel de riesgo']) !!}
      {!! Form::label('nivel_riesgo', 'Ingrese un nivel de riesgo válido', ['class' => 'validar_campo','id'=>'error_llave']) !!}
    </div>
    <div class="col-md-3">
      <button type="button" class="btn btn-outline-primary" id="agregar">Agregar</button>
      <button type="button" class="btn btn-outline-primary ocultar" id="modificar">Modificar</button>
      <button type="button" class="btn btn-outline-danger ocultar" id="reset_botones">x</button>
      <i id="spiner" class="fas fa-spinner spiner ocultar"></i>
    </div>
  
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Nivel de riesgo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
      @foreach($cargos as $cargo)
        <tr>
          <td>{{ $cargo->codigo }}</td>
          <td>{{ $cargo->nombre }}</td>
          @if($cargo->llave != null || $cargo->valor != null)
            <td>{{ $cargo->llave.' - '.$cargo->valor }}</td>
          @else
            <td></td>
          @endif
          <td>
            <button id="{{ $cargo->id }}" type="button" class="btn btn-outline-warning modificar" style="padding: 0px 3px" title="Modificar" data-toggle="tooltip">
              <i class="fas fa-pencil-alt"></i>
            </button>
            <button id="{{ $cargo->id }}" type="button" class="btn btn-outline-danger borrar" style="padding: 0px 3px" title="Eliminar" data-toggle="tooltip">
              <i class="fas fa-trash-alt"></i>
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
</table> 
{!! Form::hidden('modulo', 'cargos',['id'=>'modulo']) !!}

@endsection

@section('js')
  <script src="{{ asset('js/parametros.js') }}"></script>
@endsection