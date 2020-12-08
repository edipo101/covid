@extends('layout')

@section('title', 'ProgramaCovid | Preventivos')

@section('content-header')
<h1>
  Compras directas
  <small>Preventivos con importe mayor a Bs 50.000,00</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Preventivos</li>
</ol>
@endsection

@section('content')

  @include('_modal')
  @include('modals.delete')

  <div class="row">
    <div class="col-xs-12">
        <a href="{{route('preventivos.create')}}" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Nuevo </a>
      <div class="pull-right form-group">
        <form method="get" id="form-filter" action="{{ route('preventivos.dir') }}">
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
          <input type="text" name="p" class="form-control" placeholder="Partida" style="display: inline-block; width: 120px;" value="{{request('p')}}">
          <button type="submit" class="btn btn-info btn-flat btn-filter">Filtrar</button>
          <a href="{{route('preventivos.dir')}}" class="btn btn-success btn-flat btn-filter">Borrar</a>
          <a id="btn-downdir" class="btn btn-danger btn-filter" target="_blank" disabled><i class="fa fa-download"></i> Descargar</a>
        </form>
      </div>

      @include('_table')

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

    $('#btn-downdir').removeAttr('disabled');

    $('#btn-downdir').click(function(){
      if ($(this).attr('disabled') != 'disabled') {
        var form = $('#form-filter');
        form.attr('action', "{{route('download.mayores')}}");
        form.submit();
        form.attr('action', "{{route('preventivos.dir')}}");
      }
    });

  });
</script>
@endsection