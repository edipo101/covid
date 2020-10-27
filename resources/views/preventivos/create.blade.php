@extends('layout')

@section('title', 'ProgramaCovid | Crear preventivo')

@section('content-header')
<h1>
  Crear preventivo
  <small>Ingrese los datos del preventivo</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Crear preventivo</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="box box-primary">
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <!-- form start -->
      <form class="form-horizontal" action="{{route('preventivos.store')}}" method="POST">
        {{ csrf_field() }}
        @include('preventivos._form')

        <div class="box-footer">
          <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
          <button type="submit" class="btn btn-primary pull-right">Enviar</button>
        </div>
      </form>
    </div>{{-- end-box --}}
  </div>
</div>{{-- end-row --}}
@endsection