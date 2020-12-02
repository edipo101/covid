  <header class="main-header">

    <!-- Logo -->
    <a href="{{route('dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Programa</b>Covid</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('dist/img/avatar'.auth()->user()->avatar.'.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset('dist/img/avatar'.auth()->user()->avatar.'.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{auth()->user()->name}} - {{auth()->user()->email}}
                  <small>Miembro desde {{auth()->user()->created_at}}</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('usuarios.show', auth()->user()->id)}}" class="btn btn-default btn-flat">Ver perfil</a>
                </div>
                <div class="pull-right">
                  <form method="post" action="{{route('logout')}}">
                    {{csrf_field()}}
                    <button class="btn btn-default btn-flat">Salir</button>
                    }
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>