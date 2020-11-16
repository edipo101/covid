@extends('layout')

@section('title', 'ProgramaCovid | Formulario preventivo')

@section('content-header')
<h1>
  Editar preventivo
  <small>Ingrese los datos del preventivo</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Editar preventivo</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    @if ($errors->any())
      <div class="alert alert-danger">
        Corrige los siguientes errores:
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <div class="box box-primary">
      <!-- form start -->
      <form class="form-horizontal" action="{{ route('preventivos.update', $preven->id_preventivo) }}" method="POST">
        <input name="_method" type="hidden" value="PATCH">
        <input name="url_previous" type="hidden" value="{{old('url_previous', url()->previous())}}">
        {{ csrf_field() }}
        @include('preventivos._form')

        <div class="box-footer">
          <a href="{{old('url_previous', url()->previous())}}" class="btn btn-default">Cancelar</a>
          <button type="submit" class="btn btn-primary pull-right">Enviar</button>
        </div>
      </form>
    </div>{{-- end-box --}}
  </div>
</div>{{-- end-row --}}
@endsection


