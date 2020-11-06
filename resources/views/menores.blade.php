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
        <a href="#" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Nuevo </a>
      <div class="pull-right form-group">
        <form method="get" action="{{ route('preventivos.men') }}">
          <select name="f" id="f" class="form-control" style="display: inline-block; width: 100px;">
            <option value='' disabled selected style='display:none;'>Fuente</option>
            <option value="">Todos</option>
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
          <input type="text" name="p" class="form-control" placeholder="Partida" style="display: inline-block; width: 120px;" value="{{request('p')}}">
          <button type="submit" class="btn btn-info btn-flat btn-filter">Filtrar</button>
          <a href="{{route('preventivos.men')}}" class="btn btn-success btn-flat btn-filter">Borrar</a>
        </form>
      </div>

      @include('_table')  
      
    </div>
  </div>
@endsection

@section('script_preventivos')
<script type="text/javascript">
  $(document).ready(function(){
    $('#f').change(function(){
      var fuente = $(this).val();
      $('#o').empty();
      $('#o').append("<option value='' disabled selected style='display:none;'>Organismo</option>");
      if (fuente == 20){
        $('#o').append("<option>210</option>");
        $('#o').append("<option>230</option>");
      }
      else if (fuente == 41){
        $('#o').append("<option>111</option>");
        $('#o').append("<option>113</option>");
        $('#o').append("<option>119</option>");
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
        var label = (data.label) ? data.label : "default";
        $('#tipo').html("<span class='label label-"+label+"'>"+data.tipo+"</span>");
        
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
        
        var des = 'SIN CLASIFICAR';
        if (data.desembolso){
          switch (data.desembolso){
            case 24: des = "24 MILLONES"; break;
            case 23: des = "23 MILLONES"; break;
          }
        }
        $('#desembolso').html(des);
        
        var link = "{{config('app.url')}}"+"/preventivos/edit/"+data.id_preventivo;
        $('#btn_edit').attr('href', link);
      }, type);
    });

  });
</script>
@endsection