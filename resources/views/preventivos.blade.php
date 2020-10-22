@extends('layout')

@section('title', 'ProgramaCovid | Preventivos')

@section('content-header')
    <h1>
        Lista de preventivos
        {{-- <small>Optional description</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Preventivos</li>
    </ol>
@endsection

@section('content')
	{{-- Modal window --}}
	<div class="modal fade" id="modal-default" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Preventivo</h4>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Actualizar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 300px;">
                	<form method="get" action="{{ route('preventivos.all') }}">
                		{{-- {{ csrf_field() }} --}}
                		{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                  		<input type="text" name="search" class="form-control pull-right" placeholder="Buscar">
                		
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
                	</form>

                </div>
              </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped table-bordered">
                <tbody>
                <tr>
	                <th>No</th>
					<th>Preventivo</th>
					<th>Importe</th>
					<th style="width: 40%;">Detalle</th>
					<th>fecha_elab</th>
					<th>fecha_verif</th>
					<th>Operaciones</th>
                </tr>
                @foreach($preven as $row)
                <tr>
                	<td>{{$row->id_preventivo}}</td>
					<td>{{$row->preventivo}}</td>
					<td>{{number_format($row->importe, 2)}}</td>
					{{-- <td>{{substr($row->glosa, 0, 100)}}</td> --}}
					<td>{{$row->detalle}}</td>
					<td>{{$row->fecha_elab}}</td>
					<td>{{$row->fecha_verif}}</td>
					<td>
					<a href="{{route('preventivos.details', $row->id_preventivo)}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Ver </a>
					<a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
					<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
					</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="table-footer">
                <span class="">
                        {{-- Mostrando {{$preven->count()}} registros de {{$preven->total()}} --}}
                </span>
                <span class="pull-right">{{$preven}}</span>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

</div>
@endsection