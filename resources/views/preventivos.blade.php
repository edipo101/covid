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
    <div class="modal-dialog" style="width: 750px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detalle Preventivo</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <tbody>
              <tr>
                <th style="width:25%">Item:</th>
                <td id="id_preventivo"></td>
              </tr>
              <tr>
                <th>Preventivo:</th>
                <td id="preventivo"></td>
              </tr>
              <tr>
                <th>Importe (Bs):</th>
                <td id="importe"></td>
              </tr>
              <tr>
                <th>Secretaria:</th>
                <td id="secretaria"></td>
              </tr>
              <tr>
                <th>Unidad:</th>
                <td id="unidad"></td>
              </tr>
              <tr>
                <th>Detalle (Glosa):</th>
                <td id="detalle"></td>
              </tr>
              <tr>
                <th>Fecha elaboracion:</th>
                <td id="fecha_elab"></td>
              </tr>

              <tr>
                <th>Fuente:</th>
                <td id="fuente"></td>
              </tr>
              <tr>
                <th>Organismo:</th>
                <td id="organismo"></td>
              </tr>
              <tr>
                <th>Partida:</th>
                <td id="id_objeto"></td>
              </tr>
              <tr>
                <th>Tipo preventivo:</th>
                <td id="tipo">
                  {{-- <span class="label label-success">Approved</span> --}}
                </td>
              </tr>
              <tr>
                <th>Ubicación:</th>
                <td id="ubicacion"></td>
              </tr>
              <tr>
                <th>Progreso</th>
                <td id="progreso" style="display: none;">
                  <div class="progress progress-xs" style="display: inline-block; width: 85%">
                    <div id="porcent_barra" class="progress-bar" style="width: 55%"></div>
                  </div>
                  <span id="porcent_data" class="badge bg-red" style="margin-left: 10px;">55%</span>
                </td>
              </tr>
              <tr>
                <th>Estado:</th>
                <td id="estado"></td>
              </tr>
              <tr>
                <th>Observaciones:</th>
                <td id="obs"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button> --}}
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="btn-add">  
          <a href="{{route('preventivos.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo </a>
      </div>
      <div class="box">
        <div class="box-header">
          Mostrando <span>{{$reg->count()}} de {{$reg->total()}}</span> registros
          <div class="box-tools">
            {{-- Filtro de busqueda --}}
            <div class="input-group input-group-sm hidden-xs" style="width: 300px;">
              <form method="get" action="{{ route('preventivos.all') }}">
                <div class="input-group input-group-sm">
                  <input type="text" name="search" class="form-control" placeholder="Buscar preventivo" value="{{request('search')}}">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                    {{-- <a href="{{route('preventivos.edit', 23)}}" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Nuevo </a> --}}
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
               <th>Nro Prev</th>
               <th>Importe (Bs)</th>
               <th style="width: 40%;">Detalle (Resumen)</th>
               <th>Fecha elab</th>
               <th>Fte-Org</th>
               {{-- <th>Organismo</th> --}}
               <th>Partida</th>
               <th>Progreso</th>
               <th>(%)</th>
               <th style="width: 175px;">Operaciones</th>
              </tr>
              @foreach($reg as $row)
              <tr data-id="{{$row->id_preventivo}}">
               <td>{{$row->id_preventivo}}</td>
               <td>{{$row->preventivo}}</td>
               <td>{{number_format($row->importe, 2)}}</td>
               <td>{{$row->glosa}}</td>
               <td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
               <td>{{$row->fuente}}-{{$row->organismo}}</td>
               <td>{{$row->id_objeto}}</td>
               <td>
                <div class="progress progress-xs">
                  @php
                  $label = 'green';
                  if ($row->porcent <= 25) $label = 'red';
                  if ($row->porcent > 26 && $row->porcent <= 50) $label = 'yellow';
                  if ($row->porcent > 51 && $row->porcent <= 75) $label = 'aqua';
                  @endphp
                  <div class="progress-bar progress-bar-{{$label}}" style="width: {{$row->porcent}}%"></div>
                </div>
                <td>
                  @if (!is_null($row->porcent))
                  <span class="badge bg-{{$label}}">{{$row->porcent}}%</span>
                  @endif
                </td>
              </td>
               <td>
                 <a href="#" class="btn btn-primary btn-xs btn-view" data-toggle="modal" data-target="#modal-default"><i class="fa fa-folder"></i> Ver </a>
                 <a href="{{route('preventivos.edit', $row->id_preventivo)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                 <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a>
               </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <span class="text-center">{{$reg}}</span>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection

@section('script_preventivos')
<script type="text/javascript">
  $(document).ready(function(){
    $('.btn-view').click(function(){
      var row = $(this).parents('tr');
      var id = row.data('id');
      var data = "id="+id+"&_token={{ csrf_token()}}";
      var url = "{{route('preventivos.view')}}";
      var type = "json";
      $.post(url, data, function(data){
        $('#id_preventivo').html(data.id_preventivo);
        $('#preventivo').html(data.preventivo);
        $('#importe').html(data.importe);
        $('#secretaria').html(data.secretaria);
        $('#unidad').html(data.unidad);
        $('#detalle').html(data.glosa);
        $('#fecha_elab').html(data.fecha_elab);
        $('#fuente').html(data.fuente);
        $('#organismo').html(data.organismo);
        $('#id_objeto').html(data.id_objeto);
        var tipo;
        if (data.tipo){
          switch(data.tipo){
            case 'CM':
              tipo = 'COMPRAS MENORES' 
              break; 
            case 'CD':
              tipo = 'COMPRAS DIRECTAS O MAYORES' 
              break; 
            case 'C':
              tipo = 'CONSULTORIA' 
              break; 
            case 'RD':
              tipo = 'RETENCION O DISMINUCION' 
              break; 
          }
          $('#tipo').html(tipo);
        }
        
        if (data.porcent){       
          if (data.id_ubimen) 
            $('#ubicacion').html(data.ubimen);
          else 
            $('#ubicacion').html(data.ubidir);
          var color = 'green';
          if (data.porcent <= 25) color = 'red';
          if (data.porcent > 26 && data.porcent <= 50) color = 'yellow';
          if (data.porcent > 51 && data.porcent <= 75) color = 'aqua';
          $('#porcent_barra').removeClass();
          $('#porcent_barra').addClass('progress-bar progress-bar-'+color);
          $('#porcent_barra').width(data.porcent+'%');          
          $('#porcent_data').removeClass();
          $('#porcent_data').addClass('badge bg-'+color);
          $('#porcent_data').html(data.porcent+'%');
          $('#progreso').show();
        }
        else{
         $('#progreso').hide();
        }
        $('#estado').html(data.estado);
        $('#obs').html(data.observaciones);
      }, type);
    });
  });
</script>
@endsection