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
      <div class="pull-right form-group filter">
        <form method="get" id="form-filter" action="{{ route('preventivos.secretarias') }}">
          <select name="t" id="t" class="form-control" style="display: inline-block; width: 100px;">            
            <option value='' disabled selected style='display:none;'>Tipo</option>
            <option {!!((request('t') == 1) ? "selected=\"selected\"" : "")!!} value="1">Compra menor</option>
            <option {!!((request('t') == 2) ? "selected=\"selected\"" : "")!!} value="2">Compra mayor</option>
          </select>
          <select name="ub" id="ub" class="form-control" style="display: inline-block; width: 150px;">
            <option value='' disabled selected style='display:none;'>Ubicacion</option>
            @if(!is_null(request('t')))
            @php $ubicaciones = (request('t') == 1) ? $ubicaciones_men : $ubicaciones_dir;  @endphp            
            @foreach($ubicaciones as $key => $value)
            <option {!!((request('ub') == $key) ? "selected=\"selected\"" : "")!!} value="{{$key}}">{{$key.'. '.$value}}</option>
            @endforeach
            @endif
          </select>
          <select name="se" id="id_secretaria" class="form-control" style="display: inline-block; width: 100px;">
            <option value='' disabled selected style='display:none;'>Secretaria</option>
            @foreach($secre as $row)
            <option title="{{$row->secretaria}}" {!!((request('se') == $row->id_secretaria) ? "selected=\"selected\"" : "")!!} value="{{$row->id_secretaria}}">{{$row->sigla}}</option>
            @endforeach
          </select>
          <select name="un" id="id_unidad" class="form-control" style="display: inline-block; width: 320px;">
            <option value='' disabled selected style='display:none;'>Unidad</option>            
            @if($unidades)
            @foreach($unidades as $row)
            <option {!!((request('un') == $row->id_unidad) ? "selected=\"selected\"" : "")!!} value="{{$row->id_unidad}}">{{$row->unidad}}</option>
            @endforeach
            @endif
          </select>
          
          <button type="submit" class="btn btn-info btn-flat btn-filter"><i class="fa fa-filter"></i> Filtrar</button>
          <a href="{{route('preventivos.secretarias')}}" class="btn btn-success btn-flat btn-filter"><i class="fa fa-times"></i> Borrar</a>
          <a id="btn-pdf3" class="btn btn-danger btn-filter" target="_blank" disabled><i class="fa fa-download"></i> Descargar</a>
        </form>
      </div>

      @include('_secretarias')

    </div>
  </div>
@endsection
