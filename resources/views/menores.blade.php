@extends('layout')

@section('title', 'ProgramaCovid | Preventivos')

@section('content-header')
<h1>
  Compras menores
  <small>Preventivos con importe menor o igual a Bs 50.000,00</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Preventivos</li>
</ol>
@endsection

@section('content')

  @include('_modal')

  <div class="row">
    <div class="col-xs-12">
        <a href="{{route('preventivos.create')}}" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Nuevo </a>
      <div class="pull-right form-group filter">
        <form method="get" id="form-filter" action="{{ route('preventivos.men') }}">
          <select name="ub" id="ub" class="form-control" style="display: inline-block; width: 200px;">
            <option value='' disabled selected style='display:none;'>Ubicacion</option>
            @foreach($ubicaciones as $key => $value)
            <option {!!((request('ub') == $key) ? "selected=\"selected\"" : "")!!} value="{{$key}}">{{$key.'. '.$value}}</option>
            @endforeach
          </select>
          <select name="f" id="f" class="form-control" style="display: inline-block; width: 100px;">
            <option value='' disabled selected style='display:none;'>Fuente</option>
            <option {!!((request('f') == 20) ? "selected=\"selected\"" : "")!!}>20</option>
            <option {!!((request('f') == 41) ? "selected=\"selected\"" : "")!!}>41</option>
          </select>
          <select name="o" id="o" class="form-control" style="display: inline-block; width: 120px;">
            <option value='' disabled selected style='display:none;'>Organismo</option>
            @if (request('f') == 20)
            <option {!!((request('o') == 210) ? "selected=\"selected\"" : "")!!}>210</option>
            <option {!!((request('o') == 230) ? "selected=\"selected\"" : "")!!}>230</option>
            @elseif (request('f') == 41)
            <option {!!((request('o') == 111) ? "selected=\"selected\"" : "")!!}>111</option>
            <option {!!((request('o') == 113) ? "selected=\"selected\"" : "")!!}>113</option>
            <option {!!((request('o') == 119) ? "selected=\"selected\"" : "")!!}>119</option>
            @endif
          </select>
          <input type="text" name="p" id="partida" class="form-control" placeholder="Partida" style="display: inline-block; width: 120px;" value="{{request('p')}}">
          <button type="submit" class="btn btn-info btn-flat btn-filter"><i class="fa fa-filter"></i> Filtrar</button>
          <a href="{{route('preventivos.men')}}" class="btn btn-success btn-flat btn-filter"><i class="fa fa-times"></i> Borrar</a>
          <a id="btn-pdf2" class="btn btn-danger btn-filter" target="_blank" disabled><i class="fa fa-download"></i> Descargar</a>
        </form>
      </div>

      @include('_table')

    </div>
  </div>
@endsection