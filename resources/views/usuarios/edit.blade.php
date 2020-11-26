@extends('layout')

@section('title', 'ProgramaCovid | Editar usuario')

@section('content-header')
<h1>
  Editar perfil de usuario
  <small>Ingrese los nuevos datos del usuario</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Editar usuario</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-body">              
        <form method="post" action="{{route('usuarios.update', $user->id)}}" class="form-horizontal" style="margin-top: 15px;">
          <input name="_method" type="hidden" value="PATCH">
          <input name="url_previous" type="hidden" value="{{old('url_previous', url()->previous())}}">
          {{ csrf_field() }}
          @include('usuarios._form')
        </form>
      </div>
    </div>

  </div>
</div>
@endsection