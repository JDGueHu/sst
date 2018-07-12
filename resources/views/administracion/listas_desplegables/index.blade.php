@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb breadcrumb_custom">
    <li class="breadcrumb-item active" aria-current="page">Listas desplegables</li>
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
                <td>Areas</td>
                <td>
                <a href="{{ route('areas.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
            <tr>
                <td>ARLs</td>
                <td>
                <a href="{{ route('arl.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
            <tr>
                <td>EPSs</td>
                <td>
                <a href="{{ route('eps.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
            <tr>
                <td>Fondos de cesantias</td>
                <td>
                <a href="{{ route('fondos_cesantias.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
            <tr>
                <td>Fondos de pensiones</td>
                <td>
                <a href="{{ route('fondos_pensiones.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
            <tr>
                <td>Generos</td>
                <td>
                <a href="{{ route('generos.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
            <tr>
                <td>Grupos sanguineos</td>
                <td>
                <a href="{{ route('grupos_sanguineos.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
            <tr>
                <td>Niveles de riesgo</td>
                <td>
                <a href="{{ route('niveles_riesgo.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                </td>
            </tr>
            <tr>
                <td>Tipos de identificacion</td>
                <td>
                <a href="{{ route('tipos_identificacion.index') }}" class="btn btn-outline-primary" style="padding: 0px 3px" title="Configurar" data-toggle="tooltip">
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