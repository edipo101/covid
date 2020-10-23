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
        <li class="header">PREVENTIVOS</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{!Route::is('ejec_presup') ?: 'active'}}"><a href="{{route('ejec_presup')}}"><i class="fa fa-link"></i> <span>Ejecucion Presupuestaria</span></a></li>
        <li class="treeview {{!Route::is('preventivos.all') ?: 'menu-open'}}">
          <a href="#"><i class="fa fa-link"></i> <span>Listar preventivos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" style="{{!Route::is('preventivos.all') ?: 'display: block;'}}">
            <li class="{{!Route::is('preventivos.all') ?: 'active'}}"><a href="{{route('preventivos.all')}}">Por Fuente y Organismo</a></li>
            <li><a href="#">Por Secretarias</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>