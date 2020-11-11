<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{config('app.url')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{config('app.url')}}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{config('app.url')}}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{config('app.url')}}/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="{{config('app.url')}}/dist/css/skins/skin-blue.min.css">

  {{-- Own style --}}
  <link rel="stylesheet" href="{{config('app.url')}}/scripts/css/app.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  @include('layouts.admin.header')

  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.admin.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('content-header')
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('layouts.admin.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{config('app.url')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{config('app.url')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{config('app.url')}}/dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="{{config('app.url')}}/bower_components/chart.js/Chart.js"></script>
{{-- InputMask --}}
<script src="{{config('app.url')}}/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{config('app.url')}}/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{config('app.url')}}/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- Morris.js charts -->
<script src="{{config('app.url')}}/bower_components/raphael/raphael.min.js"></script>
<script src="{{config('app.url')}}/bower_components/morris.js/morris.min.js"></script>

{{-- Mostrar grafico de barras si corresponde --}}
@isset($tabla1)
{{-- Grafico de barras --}}
@yield('script_barras')
@endisset

<script type="text/javascript">
  var url_view = "{{route('preventivos.view')}}";
  var url_unidades = "{{route('unidades')}}";
  var token = "{{csrf_token()}}";
  var url_edit = "{{config('app.url')}}";
  $(document).ready(function(){
    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
  });
</script>

{{-- Filtrado de preventivos por secretarias --}}
@if(Route::is('preventivos.secretarias'))
<script src="{{config('app.url')}}/scripts/js/filter_secretarias.js"></script>
@endif

{{-- Ventana modal preventivo --}}
@isset($reg)
<script src="{{config('app.url')}}/scripts/js/modal_preven.js"></script>
@endisset

@isset($preven)
<script type="text/javascript">
  $(document).ready(function(){

    $('input[name=id_tipo]').change(function(){
      var tipo = $(this).val();
      $('#ubicacion').empty();

      if (tipo == 1){
        $.ajax({
            url: "{{route('ubicaciones_men')}}",
            type: 'get',
            dataType: 'json',
            data: {"id": tipo},
            success: function (response) {
                $('#ubicacion').append("<option value='' disabled selected style='display:none;'>Seleccione una opcion</option>");
                $.each(response.data, function (index, value) {
                    $('#ubicacion').append("<option value='" + value.id_ubicacion + "'>"+value.id_ubicacion+". "+ value.ubicacion + "</option>");
                });
            }
        });
      }

      if (tipo == 2){
        // alert('tipo2');
        $.ajax({
            url: "{{route('ubicaciones_dir')}}", type: 'get', dataType: 'json',
            success: function (response) {
                $('#ubicacion').append("<option value='' disabled selected style='display:none;'>Seleccione una opcion</option>");
                $.each(response.data, function (index, value) {
                    $('#ubicacion').append("<option value='" + value.id_ubicacion + "'>"+value.id_ubicacion+". "+ value.ubicacion + "</option>");
                });
            }
        });
      }
    });

    $('#id_secretaria').change(function(){
      var id_secretaria = $(this).val();
      $('#id_unidad').empty();
      $.ajax({
        url: "{{route('unidades')}}",
        type: 'get',
        dataType: 'json',
        data: {"id": id_secretaria},
        success: function (response) {
            $('#id_unidad').append("<option value='' disabled selected style='display:none;'>Seleccione una opcion</option>");
            $.each(response.data, function (index, value) {
                $('#id_unidad').append("<option value='" + value.id_unidad + "'>"+ value.unidad + "</option>");
            });
        }
      });
    });

  });
</script>
@endisset

</body> </html>