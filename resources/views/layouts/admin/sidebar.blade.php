  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{config('app.url')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Usuario</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">        
        <li class="{{!Route::is('dashboard') ?: 'active'}}"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Principal</span></a></li>
        <li class="header">PREVENTIVOS</li>
        @php
        $ruta = Route::currentRouteName();
        switch ($ruta) {
          case 'preventivos.all':
          case 'preventivos.men':
          case 'preventivos.dir':
          case 'preventivos.secretarias':
          case 'preventivos.liberados':
            $menu = 'menu-open';
            $view = 'display: block;';
            break;
          default:
            $menu = '';
            $view = 'display: none;';
            break;
        }
        @endphp
        <li class="treeview {{$menu}}">
          <a href="#"><i class="fa fa-table"></i> <span>Listar preventivos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" style="{{$view}}">
            <li class="{{!Route::is('preventivos.all') ?: 'active'}}"><a href="{{route('preventivos.all')}}"><i class="fa fa-circle-o"></i> Por Fuente y Organismo</a></li>
            <li class="{{!Route::is('preventivos.men') ?: 'active'}}"><a href="{{route('preventivos.men')}}"><i class="fa fa-circle-o"></i> Compras menores</a></li>
            <li class="{{!Route::is('preventivos.dir') ?: 'active'}}"><a href="{{route('preventivos.dir')}}"><i class="fa fa-circle-o"></i> Compras mayores o directas</a></li>
            <li class="{{!Route::is('preventivos.secretarias') ?: 'active'}}"><a href="{{route('preventivos.secretarias')}}"><i class="fa fa-circle-o"></i> Por Secretarias</a></li>
            <li class="{{!Route::is('preventivos.liberados') ?: 'active'}}"><a href="{{route('preventivos.liberados')}}"><i class="fa fa-circle-o"></i> Por liberar</a></li>
          </ul>
        </li>

        <li class="header">REPORTES</li>
        <li class="{{!Route::is('ejec_presup') ?: 'active'}}"><a href="{{route('ejec_presup')}}"><i class="fa fa-pie-chart"></i> <span>Ejecucion Presupuestaria</span></a></li>
        <li class="{{!Route::is('partidas.presupuesto') ?: 'active'}}"><a href="{{route('partidas.presupuesto')}}"><i class="fa fa-pie-chart"></i> <span>Saldo disponible</span></a></li>
        <li><a href="{{route('desembolsos')}}"><i class="fa fa-table"></i> <span>Desembolsos</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>