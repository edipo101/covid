@extends('layout')

@section('title', 'ProgramaCovid | Preventivos')

@section('content-header')
<h1>
  Preventivos por liberar
  {{-- <small>Lista general de todos los preventivos por secretaria y unidad</small> --}}
</h1>
<ol class="breadcrumb">
  <li><a href="{{route('download')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Preventivos</li>
</ol>
@endsection

@section('content')

  @include('_modal')
  @include('modals.delete')

  <div class="row">
    <div class="col-xs-12">
        <a href="#" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Nuevo </a>
      <div class="pull-right form-group filter">
        <form method="get" id="form-filter" action="{{ route('preventivos.liberados') }}">
          <select name="t" id="t" class="form-control" style="display: inline-block; width: 150px;">            
            <option value='' disabled selected style='display:none;'>Tipo</option>
            <option {!!((request('t') == 1) ? "selected=\"selected\"" : "")!!} value="1">Compra menor</option>
            <option {!!((request('t') == 2) ? "selected=\"selected\"" : "")!!} value="2">Compra mayor</option>
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
          <button type="submit" class="btn btn-info btn-flat btn-filter">Filtrar</button>
          <a href="{{route('preventivos.liberados')}}" class="btn btn-success btn-flat btn-filter">Borrar</a>
          <a id="btn-downlib" class="btn btn-danger btn-filter" disabled><i class="fa fa-download"></i> Descargar</a>
        </form>
      </div>

      @include('_liberados')

    </div>
  </div>
@endsection

@section('javascript')
<script>
  $(document).ready(function(){
    var id;

    $('.btn-delete').click(function(){
      var prev = $(this).parents('tr').find("td")[0].innerHTML;
      var row = $(this).parents('tr');
      id = row.data('id');
      $('#reg').html(prev);
    });

    $('#btn-delete').click(function(){
      var data = "id="+id+"&_token="+token;
      var url = "{{route('preventivos.destroy')}}";
      var type = "json";
      $.post(url, data, function(data){
          console.log('!El registro fue eliminado correctamente!');
      });
      $('#btn-cancel').click();
      location.reload();
    });
    
    if (reg > 0)
      if ((t != "") || (fuente != "" && org != ""))
        $('#btn-downlib').removeAttr('disabled');

    $('#btn-downlib').click(function(){
      if ($(this).attr('disabled') != 'disabled') {
        var form = $('#form-filter');
        form.attr('action', "{{route('download.liberados')}}");
        form.submit();
        form.attr('action', "{{route('preventivos.liberados')}}");
      }
    });

  });
</script>
@endsection
