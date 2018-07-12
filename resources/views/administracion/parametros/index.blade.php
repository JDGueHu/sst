@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item active" aria-current="page">Parámetros</li>
  </ol>
</nav>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
              <th>Nombre</th>
              <th>Acción</th>
          </tr>
      </thead>
        <tbody>
            <tr>
                <td>Centros de trabajo</td>
                <td>
                <a href="{{ route('centros_trabajo.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
      </tbody>
  </table> 

@endsection

@section('js')
  <script src="{{ asset('js/tabla_simple.js') }}"></script>
@endsection