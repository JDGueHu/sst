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
            <th>Foto</th>
            <th>Identificación</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
          <td class="centrar"><img src="{{ $empleado->foto }}" height="42" width="42"></td>
          <td>{{ $empleado->identificacion }}</td>
          <td>{{ $empleado->nombres }}</td>
          <td>{{ $empleado->apellidos }}</td> 
          @if($empleado->activo == 1)
            <td>              
              <span class="badge badge-success">Activo</span>
            </td>
          @else
            <td>
                <span class="badge badge-danger">Inactivo</span>
            </td>
          @endif         
          <td>
            <a title="Detalles" data-toggle="tooltip" href="{{ route('empleados.show',$empleado->id) }}" style="padding: 0px 3px" class="btn btn-outline-primary">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
            <a title="Editar" data-toggle="tooltip" href="{{ route('empleados.show',$empleado->id) }}" style="padding: 0px 3px" class="btn btn-outline-warning">
                <i class="fas fa-pencil-alt"></i>
            </a>
            <a title="Activar" data-toggle="tooltip" href="{{ route('empleados.show',$empleado->id) }}" style="padding: 0px 3px" class="btn btn-outline-success">
                <i class="far fa-check-circle"></i>
            </a>
            <a title="Inactivar" data-toggle="tooltip" href="{{ route('empleados.show',$empleado->id) }}" style="padding: 0px 3px" class="btn btn-outline-danger">
                <i class="far fa-times-circle"></i>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
</table> 
{!! Form::hidden('modulo', 'empleados',['id'=>'modulo']) !!}

@endsection

@section('js')
  <script src="{{ asset('js/tabla.js') }}"></script>
@endsection