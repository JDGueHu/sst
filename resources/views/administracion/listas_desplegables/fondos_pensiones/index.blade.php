@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item color_breadcrum_href"><a href="{{ route('listas_desplegables.index') }}">Listas desplegables</a></li>
    <li class="breadcrumb-item active" aria-current="page">Fondos de pensiones</li>
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
      <button type="button" class="btn btn-outline-primary" id="boton_agregar_fondos_pensiones">Agregar</button>
    </div>
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Llave</th>
            <th>Valor</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
      @foreach($fondos_pensiones as $fondo_pension)
        <tr>
          <td>{{ $fondo_pension->llave }}</td>
          <td>{{ $fondo_pension->valor }}</td>
          <td>
            <button id="{{ $fondo_pension->id }}" type="button" class="btn btn-outline-danger borrar_fondo_pension" style="padding: 0px 3px" title="Eliminar" data-toggle="tooltip">
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