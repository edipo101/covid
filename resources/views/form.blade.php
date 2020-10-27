@extends('layout')

@section('title', 'ProgramaCovid | Formulario preventivo')

@section('content-header')
<h1>
  Formulario preventivo
  <small>Ingrese los datos del preventivo</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Formulario preventivo</li>
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
      <form class="form-horizontal" action="{{ route('preventivos.update', $row->id_preventivo) }}" method="POST">
        <input name="_method" type="hidden" value="PATCH">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label" for="nro_preven">Nro preventivo</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="nro_preven" name="nro_preven" placeholder="" value="{{$row->preventivo}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Importe (Bs)</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="importe" name="importe" value="{{$row->importe}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Detalle</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="detalle" id="detalle" cols="30" rows="6">{{$row->glosa}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="fecha_elab">Fecha elaboracion</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="fecha_elab" name="fecha_elab" placeholder="" value="{{date("d/m/Y", strtotime($row->fecha_elab))}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Fuente</label>
            <div class="col-sm-3">
                <select class="form-control" id="fuente" name="fuente">
                  <option {!!(($row->fuente == 20) ? "selected=\"selected\"" : "")!!}>20</option>
                  <option {!!(($row->fuente == 41) ? "selected=\"selected\"" : "")!!}>41</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Organismo</label>
            <div class="col-sm-3">
              <select class="form-control" id="organismo" name="organismo">
                <option {!!(($row->organismo == 210) ? "selected=\"selected\"" : "")!!}>210</option>
                <option {!!(($row->organismo == 230) ? "selected=\"selected\"" : "")!!}>230</option>
                <option {!!(($row->organismo == 111) ? "selected=\"selected\"" : "")!!}>111</option>
                <option {!!(($row->organismo == 113) ? "selected=\"selected\"" : "")!!}>113</option>
                <option {!!(($row->organismo == 119) ? "selected=\"selected\"" : "")!!}>119</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Partida</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="partida" name="partida" placeholder="" value="{{$row->id_objeto}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Ubicacion</label>
            <div class="col-sm-3">
              <select class="form-control" id="ubicacion" name="ubicacion">
                <option></option>
                @foreach($ubicaciones as $ubicacion)
                  <option {!!(($ubicacion == $row->ubicacion) ? "selected=\"selected\"" : "")!!}>{{$ubicacion}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Estado</label>
            <div class="col-sm-3">
              <select class="form-control" id="estado" name="estado">
                <option></option>
                @foreach($estados as $estado)
                  <option {!!(($estado == $row->estado) ? "selected=\"selected\"" : "")!!}>{{$estado}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
          <button type="submit" class="btn btn-primary pull-right">Enviar</button>
        </div>
      </form>
    </div>{{-- end-box --}}
  </div>
</div>{{-- end-row --}}
@endsection