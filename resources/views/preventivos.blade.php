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
          {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Editar</button> --}}
          <a id="btn_edit" href="#" class="btn btn-info btn-flat"><i class="fa fa-pencil"></i> Editar </a>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
        <a href="#" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Nuevo </a>
      <div class="pull-right form-group">
        <form method="get" action="{{ route('preventivos.all') }}">
          <select name="fuente2" id="fuente2" class="form-control" style="display: inline-block; width: 100px;">
            <option value='' disabled selected style='display:none;'>Fuente</option>
            <option value="">Todos</option>
            <option {!!((request('fuente2') == 20) ? "selected=\"selected\"" : "")!!}>20</option>
            <option {!!((request('fuente2') == 41) ? "selected=\"selected\"" : "")!!}>41</option>
          </select>
          <select name="organismo2" id="organismo2" class="form-control" style="display: inline-block; width: 120px;">
            <option value='' disabled selected style='display:none;'>Organismo</option>  
            @if (request('fuente2') == 20)
            <option {!!((request('organismo2') == 210) ? "selected=\"selected\"" : "")!!}>210</option>
            <option {!!((request('organismo2') == 230) ? "selected=\"selected\"" : "")!!}>230</option>
            @elseif (request('fuente2') == 41)
            <option {!!((request('organismo2') == 111) ? "selected=\"selected\"" : "")!!}>111</option>
            <option {!!((request('organismo2') == 113) ? "selected=\"selected\"" : "")!!}>113</option>
            <option {!!((request('organismo2') == 119) ? "selected=\"selected\"" : "")!!}>119</option>
            @endif        
          </select>
          <input type="text" name="partida2" class="form-control" placeholder="Partida" style="display: inline-block; width: 120px;" value="{{request('partida2')}}">
          <button type="submit" class="btn btn-info btn-flat">Filtrar</button>
          <a href="{{route('preventivos.all')}}" class="btn btn-success btn-flat">Borrar</a>
        </form>
      </div>

      <div class="box">
        <div class="box-header">
          Mostrando <span>{{$reg->count()}} de {{$reg->total()}}</span> registros
          <div class="box-tools">
            {{-- Filtro de busqueda --}}
            <div class="input-group input-group-sm hidden-xs">
              <form method="get" action="{{ route('preventivos.all') }}">
                <div class="input-group input-group-sm">
                  <input type="text" name="search" class="form-control" placeholder="Buscar preventivo" value="{{request('search')}}">
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
               {{-- <th>Item</th> --}}
               <th>Nro Prev</th>
               <th>Importe (Bs)</th>
               <th style="width: 40%;">Detalle (Resumen)</th>
               <th>Fecha elab</th>
               <th>Fte-Org</th>
               {{-- <th>Organismo</th> --}}
               <th>Partida</th>
               <th>Tipo</th>
               <th>Progreso</th>
               <th>(%)</th>
               <th style="width: 175px;">Operaciones</th>
              </tr>
              @foreach($reg as $row)
              <tr data-id="{{$row->id_preventivo}}">
               {{-- <td>{{$row->id_preventivo}}</td> --}}
               <td>{{$row->preventivo}}</td>
               <td>{{number_format($row->importe, 2)}}</td>
               <td>{{$row->glosa}}</td>
               <td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
               <td>{{$row->fuente}}-{{$row->organismo}}</td>
               <td>{{$row->id_objeto}}</td>
               <td>{{$row->tipo}}</td>
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
                 {{-- <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a> --}}
               </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <span class="text-center">
          {{$reg->appends(Request::all())->links()}}
          </span>
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
    $('#fuente2').change(function(){
      var fuente = $(this).val();
      $('#organismo2').empty();
      $('#organismo2').append("<option value='' disabled selected style='display:none;'>Organismo</option>");
      if (fuente == 20){
        $('#organismo2').append("<option>210</option>");
        $('#organismo2').append("<option>230</option>");
      }
      else if (fuente == 41){
        $('#organismo2').append("<option>111</option>");
        $('#organismo2').append("<option>113</option>");
        $('#organismo2').append("<option>119</option>");
      }
    });

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
        if (data.secretaria)
          $('#secretaria').html(data.secretaria+' ('+data.sigla+')');
        else
          $('#secretaria').html();
        $('#unidad').html(data.unidad);
        $('#detalle').html(data.glosa);
        $('#fecha_elab').html(data.fecha_elab);
        $('#fuente').html(data.fuente);
        $('#organismo').html(data.organismo);
        $('#id_objeto').html(data.id_objeto);
        $('#tipo').html(data.tipo);
        
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
        var obs = 'NINGUNO';
        if (data.observaciones)
          obs = data.observaciones;
        $('#obs').html(obs);
        var link = "{{config('app.url')}}"+"/preventivos/edit/"+data.id_preventivo;
        // console.log(link);
        $('#btn_edit').attr('href', link);
      }, type);
    });

  });
</script>
@endsection