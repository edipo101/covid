@extends('layout')

@section('title', 'ProgramaCovid | Preventivos')

@section('content-header')
<h1>
  Preventivos (por Secretarias y unidades)
  <small>Lista general de todos los preventivos por secretaria y unidad</small>
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('download')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Preventivos</li>
</ol>
@endsection

@section('content')

  @include('_modal')

  <div class="row">
    <div class="col-xs-12">
        <a href="#" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Nuevo </a>
      <div class="pull-right form-group">
        <form method="get" action="{{ route('preventivos.secretarias') }}">
          <select name="se" id="id_secretaria" class="form-control" style="display: inline-block; width: 150px;">
            <option value='' disabled selected style='display:none;'>Secretaria</option>
            @foreach($secre as $row)
            <option title="{{$row->secretaria}}" {!!((request('se') == $row->id_secretaria) ? "selected=\"selected\"" : "")!!} value="{{$row->id_secretaria}}">{{$row->sigla}}</option>
            @endforeach
          </select>
          <select name="un" id="id_unidad" class="form-control" style="display: inline-block; width: 450px;">
            <option value='' disabled selected style='display:none;'>Unidad</option>            
          </select>
          <button type="submit" class="btn btn-info btn-flat btn-filter">Filtrar</button>
          <a href="{{route('preventivos.secretarias')}}" class="btn btn-success btn-flat btn-filter">Borrar</a>
        </form>
      </div>

      @include('_secretarias')

    </div>
  </div>
@endsection
