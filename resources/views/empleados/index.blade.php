@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item color_breadcrum_href"><a href="#">Empleados</a></li>
</ol>
</nav>

<a href="{{ route('empleados.create') }}" class="btn btn-primary separar_boton">Crear</a>

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

    </tbody>
</table> 
{!! Form::hidden('modulo', 'empleados',['id'=>'modulo']) !!}

@endsection

@section('js')
  <script src="{{ asset('js/tabla.js') }}"></script>
@endsection