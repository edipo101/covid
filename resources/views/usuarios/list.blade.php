@extends('layout')

@section('title', 'ProgramaCovid | Listar usuarios')

@section('content-header')
<h1>
  Lista de usuarios
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Listar usuarios</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <a href="{{route('usuarios.create')}}" class="btn btn-success" style="margin-bottom: 10px;">
      <i class="fa fa-plus"></i> Nuevo </a>
      <div class="box box-primary">
        <div class="box-body">    
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Creado el</th>
                <th>Ult. modificación</th>
                <th>Operaciones</th>
              </tr>
            </thead>
            <tbody> 
              <tr>
                @foreach($users as $user)             
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td>
                  <a href="#" class="btn btn-primary btn-xs btn-view" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i> Ver </a>
                  <a href="{{route('usuarios.edit', $user->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
  @endsection