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
  @yield('script_barras')
  @endisset

  <script type="text/javascript">
    var url_view = "{{route('preventivos.view')}}";
    var url_pdf = "{{route('download')}}";
    var url_pdf_menores = "{{route('download.menores')}}";
    var url_pdf_secretarias = "{{route('download.secretarias')}}";
    var url_preventivos = "{{route('preventivos.all')}}";
    var url_menores = "{{route('preventivos.men')}}";
    var url_secretarias = "{{route('preventivos.secretarias')}}";
    var url_ubicaciones_men = "{{route('ubicaciones_men')}}";
    var url_ubicaciones_dir = "{{route('ubicaciones_dir')}}";
    var url_presupuesto = "{{route('partidas.presupuesto')}}";
    var url_pdf_presupuesto = "{{route('download.presupuesto')}}";
    var url_unidades = "{{route('unidades')}}";
    var token = "{{csrf_token()}}";
    var url_edit = "{{config('app.url')}}";
    var fuente = "{{request('f')}}";
    var org = "{{request('o')}}";
    var partida = "{{request('p')}}";
    var reg = {{isset($reg) ? $reg->count() : 0}};
    var ub = "{{request('ub')}}";
    var se = "{{request('se')}}";
    var un = "{{request('un')}}";
    var t = "{{request('t')}}";

    $(document).ready(function(){
      $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    });
  </script>

  @yield('javascript')

  {{-- Filtrado de preventivos por secretarias --}}
  @if((Route::is('preventivos.secretarias')) or (Route::is('preventivos.liberados')))
  <script src="{{config('app.url')}}/scripts/js/filter_secretarias.js"></script>
  @endif

  @if((Route::is('usuarios.show')))
  <script type="text/javascript">
    $(document).ready(function(){
      $('#chg-avatar').click(function(){
       $('input[name=image]:radio').prop('checked', false);
       $('#btn-save').prop('disabled', true);
     });

      $('input[name=image]:radio').change(function(){
        $('#btn-save').prop('disabled', false);
      });
    });
  </script>
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
            url: "{{route('ubicaciones_men')}}", type: 'get', dataType: 'json',
            success: function (response) {
              $('#ubicacion').append("<option value='' disabled selected style='display:none;'>Seleccione una opcion</option>");
              $.each(response.data, function (index, value) {
                $('#ubicacion').append("<option value='" + value.id_ubicacion + "'>"+value.id_ubicacion+". "+ value.ubicacion + "</option>");
              });
            }
          });
        }

        if (tipo == 2){
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

        if (tipo == 7){
          $('#importe').val(0);
          $('#pagado').val(0);
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