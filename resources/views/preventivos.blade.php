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
{{-- <div class="modal fade" id="modal-default" style="display: none;">
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
  </div> --}}

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
            Mostrando <span>{{$preven->count()}} de {{$preven->total()}}</span> Artículos
          <div class="box-tools">
            {{-- Filtro de busqueda --}}
            <div class="input-group input-group-sm hidden-xs" style="width: 300px;">
             <form method="get" action="{{ route('preventivos.all') }}">
                <div class="input-group input-group-sm">
                  <input type="text" name="search" class="form-control" placeholder="Buscar" value="{{request('search')}}">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                  </span>
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
             <th>Item</th>
             <th>No. Preventivo</th>
             <th>Importe</th>
             <th style="width: 40%;">Detalle</th>
             <th>Fecha elab</th>
             <th>Fuente</th>
             <th>Organismo</th>
             <th>Operaciones</th>
           </tr>
           @foreach($preven as $row)
           <tr>
             <td>{{$row->id_preventivo}}</td>
             <td>{{$row->preventivo}}</td>
             <td>{{number_format($row->importe, 2)}}</td>
             {{-- <td>{{substr($row->glosa, 0, 100)}}</td> --}}
             <td>{{$row->glosa}}</td>
             <td>{{$row->fecha_elab}}</td>
             <td>{{$row->fuente}}</td>
             <td>{{$row->organismo}}</td>
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
        <span class="text-center">{{$preven}}</span>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

</div>
@endsection