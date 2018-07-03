@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item color_breadcrum_href"><a href="{{ route('listas_desplegables.index') }}">Listas desplegables</a></li>
    <li class="breadcrumb-item active" aria-current="page">EPSs</li>
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
      <button type="button" class="btn btn-outline-primary" id="boton_agregar_eps">Agregar</button>
      <button type="button" class="btn btn-outline-primary ocultar" id="boton_modificar_eps">Modificar</button>
      <button type="button" class="btn btn-outline-danger ocultar" id="reset_botones_eps">x</button>
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
      @foreach($epss as $eps)
        <tr>
          <td>{{ $eps->llave }}</td>
          <td>{{ $eps->valor }}</td>
          @if($eps->valor_por_defecto == null)
            <td>
              <span class="badge badge-danger">No</span>
            </td>
          @else
            <td>
              <span class="badge badge-success">Si</span>
            </td>
          @endif
          <td>
          <button id="{{ $eps->id }}" type="button" class="btn btn-outline-warning modificar_eps" style="padding: 0px 3px" title="Modificar" data-toggle="tooltip">
              <i class="fas fa-pencil-alt"></i>
            </button>
            <button id="{{ $eps->id }}" type="button" class="btn btn-outline-danger borrar_eps" style="padding: 0px 3px" title="Eliminar" data-toggle="tooltip">
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