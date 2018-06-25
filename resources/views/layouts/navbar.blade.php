<nav class="navbar navbar-expand-lg navbar-light nav_custom">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" id="sidebarCollapse" class="btn btn-light">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="user_name_custo">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                    </a>
                    <div class="dropdown-menu margin_lef_ajuste" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Perfil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>   

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>                                     
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>