<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ProgramaCovid | Iniciar sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{config('app.url')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{config('app.url')}}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{config('app.url')}}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{config('app.url')}}/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  {{-- <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css"> --}}

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{route('dashboard')}}"><b>Programa</b>Covid</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese sus credenciales para iniciar su sesión</p>

    <form action="{{route('login')}}" method="post">
      {{csrf_field()}}
      <div class="form-group has-feedback {{$errors->has('email') ? 'has-error' : ''}}">
        <input name="email" type="email" class="form-control" value="{{old('email')}}" placeholder="Correo electronico">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        {!! $errors->first('email', '<span class="help-block">:message</span>')!!}
      </div>
      <div class="form-group has-feedback {{$errors->has('password') ? 'has-error' : ''}}">
        <input name="password" type="password" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        {!! $errors->first('password', '<span class="help-block">:message</span>')!!}
      </div>
      <div class="row">
        <div class="col-xs-4 col-xs-offset-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{config('app.url')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{config('app.url')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{config('app.url')}}/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
