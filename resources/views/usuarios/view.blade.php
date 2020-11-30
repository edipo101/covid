@extends('layout')

@section('title', 'ProgramaCovid | Perfil usuario')

@section('content-header')
<h1>
  Perfil de usuario
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li><a href="{{route('usuarios.index')}}">Listar usuarios</a></li>
  <li class="active">Perfil de usuario</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
  	<div class="box box-primary">
  		<div class="box-body">
  			<div style="display: block;" class="col-md-12">
  				<label style="text-align: right; float: left;" class="col-md-2">Nombre</label> {{$user->name}}
  			</div>
  			<div style="display: block;" class="col-md-12">
  				<label style="text-align: right; float: left;" class="col-md-2">Login</label> {{$user->email}}
  			</div>
  		</div>
  	</div>
  </div>
</div>
@endsection