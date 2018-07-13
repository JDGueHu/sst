<!-- Sidebar Holder -->
<nav id="sidebar" class="">
  
  <div class="logo">
    <a class="nav-link" href="{{ route('home') }}">
      SSGT
    </a>
  </div>  
  <ul id="accordion1" class="nav nav-pills flex-column">

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#item-1" data-parent="#accordion1">
        <div class="row">
          <div class="col-2">
            <i class="fas fa-cogs" style="color:#673ab7;"></i> 
          </div>
          <div class="col-8 color_opcion_menu">
            Administración
          </div>
          <div class="col-2 color_opcion_menu">
            <i class="fas fa-caret-down"></i>
          </div>
        </div>        
      </a>

      <div id="item-1" class="collapse">
        <ul class="nav flex-column ml-3">
          <li class="nav-item">
            <a class="nav-link color_opcion_menu" href="{{ route('listas_desplegables.index') }}">Listas desplegables</a>
          </li>
          <li class="nav-item">
            <a class="nav-link color_opcion_menu" href="{{ route('parametros.index') }}">Parámetros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link color_opcion_menu" href="#">Usuarios</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('empleados.index') }}">
        <div class="row">
          <div class="col-2">
            <i class="fas fa-users" style="color:#ff5722;"></i>
          </div>
          <div class="col-8 color_opcion_menu">
            Empleados
          </div>
          <div class="col-2">
          </div>        
        </div>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <div class="row">
          <div class="col-2">
            <i class="fas fa-file-alt" style="color:#2196f3;"></i>
          </div>
          <div class="col-8 color_opcion_menu">
            Contratos
          </div>
          <div class="col-2">
          </div>        
        </div>       
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <div class="row">
            <div class="col-2">
              <i class="fas fa-graduation-cap" style="color:#04B404;"></i>
            </div>
            <div class="col-8 color_opcion_menu">
              Formación
            </div>
            <div class="col-2">
            </div>        
        </div>       
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <div class="row">
            <div class="col-2">
              <i class="fas fa-briefcase-medical" style="color:#f44336;"></i>
            </div>
            <div class="col-8 color_opcion_menu">
              Exámenes
            </div>
            <div class="col-2">
            </div>        
        </div>      
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <div class="row">
            <div class="col-2">
              <i class="fas fa-sign-out-alt" style="color:#ff9800;"></i>
            </div>
            <div class="col-8 color_opcion_menu">
              Ausentismo
            </div>
            <div class="col-2">
            </div>        
        </div>       
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <div class="row">
            <div class="col-2">
             <i class="fas fa-shield-alt" style="color:#0404B4;"></i>
            </div>
            <div class="col-8 color_opcion_menu">
              SST
            </div>
            <div class="col-2">
            </div>        
        </div>  
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <div class="row">
            <div class="col-2">
              <i class="fas fa-file" style="color:#D7DF01;"></i>
            </div>
            <div class="col-8 color_opcion_menu">
              Adjuntos
            </div>
            <div class="col-2 ">
            </div>        
        </div>       
      </a>
    </li>

    <li class="nav-item">

      <a class="nav-link" data-toggle="collapse" href="#item-2" data-parent="#accordion1">
        <div class="row">
          <div class="col-2">
            <i class="fas fa-table" style="color:#9c27b0;"></i> 
          </div>
          <div class="col-8 color_opcion_menu">
            Matrices
          </div>
          <div class="col-2 color_opcion_menu">
            <i class="fas fa-caret-down"></i>
          </div>        
        </div>      
      </a> 

      <div id="item-2" class="collapse">
        <ul class="nav flex-column ml-3">
          <li class="nav-item">
            <a class="nav-link color_opcion_menu" href="#">Roles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link color_opcion_menu" href="#">Requisitos legales</a>
          </li>
        </ul>
      </div>
    </li>

  </ul>


</nav>


