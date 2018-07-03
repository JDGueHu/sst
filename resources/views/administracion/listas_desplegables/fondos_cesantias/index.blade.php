@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item color_breadcrum_href"><a href="{{ route('listas_desplegables.index') }}">Listas desplegables</a></li>
    <li class="breadcrumb-item active" aria-current="page">Fondos de cesantías</li>
</ol>
</nav>

<div class="row separar_boton">   
    <div class="col-md-3">
        {!! Form::text('llave',null, ['class' => 'form-control', 'id'=>'llave', 'placeholder'=>'Llave'])  !!}
        {!! Form::label('llave', 'Ingrese una llave válida', ['class' => 'validar_campo','id'=>'error_llave']) !!}
    </div>
    <div class="col-md-3">
        {!! Form::text('valor',null, ['class' => 'form-control', 'id'=>'valor', 'placeholder'=>'Valor'])  !!}
        {!! Form::label('llave', 'Ingrese un valor válido', ['class' => 'validar_campo','id'=>'error_valor']) !!}
    </div>
    <div class="col-md-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="valor_por_defecto">
        <label class="form-check-label" for="valor_por_defecto">
          ¿Valor por defecto?
        </label>
      </div>
    </div>
    <div class="col-md-3">
      <button type="button" class="btn btn-outline-primary" id="boton_agregar_fondos_cesantias">Agregar</button>
      <button type="button" class="btn btn-outline-primary ocultar" id="modificar_fondos_cesantias">Modificar</button>
      <button type="button" class="btn btn-outline-danger ocultar" id="reset_botones_fondos_cesantias">x</button>
      <i id="spiner" class="fas fa-spinner spiner ocultar"></i>
    </div>
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Llave</th>
            <th>Valor</th>
            <th>¿Valor por defecto?</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
      @foreach($fondos_cesantias as $fondo_cesantias)
        <tr>
          <td>{{ $fondo_cesantias->llave }}</td>
          <td>{{ $fondo_cesantias->valor }}</td>
          @if($fondo_cesantias->valor_por_defecto == null)
            <td>
              <span class="badge badge-danger">No</span>
            </td>
          @else
            <td>
              <span class="badge badge-success">Si</span>
            </td>
          @endif
          <td>
            <button id="{{ $fondo_cesantias->id }}" type="button" class="btn btn-outline-warning modificar_fondo_cesantia" style="padding: 0px 3px" title="Modificar" data-toggle="tooltip">
              <i class="fas fa-pencil-alt"></i>
            </button>
            <button id="{{ $fondo_cesantias->id }}" type="button" class="btn btn-outline-danger borrar_fondo_cesantia" style="padding: 0px 3px" title="Eliminar" data-toggle="tooltip">
              <i class="fas fa-trash-alt"></i>
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
</table> 

@endsection

@section('js')
  <script src="{{ asset('js/tabla_listas_ajax.js') }}"></script>
@endsection