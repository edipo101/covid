@extends('layout')

@section('title', 'ProgramaCovid | Partidas presupuesto')

@section('content-header')
<h1>
  Ejecución presupuestaria por partidas
  {{-- <small>Vista general de </small> --}}
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li><a href="#"> Partidas</a></li>
  <li class="active">Ejecucion presupuestaria</li>
</ol>
@endsection

@section('content')

  @include('_modal')

  <div class="row">
    <div class="col-xs-12">
      <div class="form-group filter" style="text-align: right;">
        <form id="form-filter" method="get" action="{{ route('partidas.presupuesto') }}">
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
          
          <button id="btn-filter" type="submit" class="btn btn-info btn-flat btn-filter"><i class="fa fa-filter"></i> Filtrar</button>
          <a href="{{route('partidas.presupuesto')}}" class="btn btn-success btn-flat btn-filter"><i class="fa fa-times"></i> Borrar</a>
          <a id="btn-pdf4" class="btn btn-danger btn-filter" disabled><i class="fa fa-download"></i> Descargar</a>
        </form>
      </div>

      @include('partidas._table_partidas')

    </div>
  </div>
@endsection
