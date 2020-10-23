@extends('layout')

@section('title', 'ProgramaCovid | Ejecucion presupuestaria')

@section('content-header')
<h1>
  Ejecución presupuestaria
  <small>Corte a septiembre de 2020</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Ejecucion Presupuestaria</li>
</ol>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
          	<b>Fuente:</b> 20 &nbsp;&nbsp;<b>Organismo:</b> 210
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
             <th>No</th>
             <th>Fuente</th>
             <th>Organismo</th>
             <th>Partida</th>
             <th style="width: 50%">Descripcion</th>
             <th>Cant</th>
             <th>Subtotal</th>
           </tr>
           @foreach($tabla1 as $row)
           <tr data-id="{{$row->id_preventivo}}">
             <td>{{++$loop->index}}</td>
             <td>{{$row->fuente}}</td>
             <td>{{$row->organismo}}</td>
             <td>{{$row->id_objeto}}</td>
             <td>{{$row->descripcion}}</td>
             <td>{{$row->cant}}</td>
             <td>{{number_format($row->subtotal, 2)}}</td>
           </tr>
           @endforeach
         </tbody>
       </table>
       <div class="table-footer">
        {{-- <span class="text-center">{{$rows}}</span> --}}
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

</div>
@endsection