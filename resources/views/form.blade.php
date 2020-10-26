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
  <div class="col-md-7">
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
            <div class="col-sm-9">
              <input type="text" class="form-control" id="nro_preven" name="nro_preven" placeholder="" value="{{$row->preventivo}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Importe</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="importe" name="importe" value="{{$row->importe}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Detalle</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="detalle" id="detalle" cols="30" rows="10">{{$row->glosa}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="fecha_elab">Fecha elaboracion</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="fecha_elab" name="fecha_elab" placeholder="" value="{{$row->fecha_elab}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Fuente</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="fuente" name="fuente" placeholder="" value="{{$row->fuente}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Organismo</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="organismo" name="organismo" placeholder="" value="{{$row->organismo}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Partida</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="partida" name="partida" placeholder="" value="{{$row->id_objeto}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Ubicacion</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="" value="{{$row->ubicacion}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Estado</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="estado" name="estado" placeholder="" value="{{$row->estado}}">
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