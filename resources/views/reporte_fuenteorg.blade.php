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
    <div class="col-md-5">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title"></h3>
          	<h3 class="box-title">Fuente: 20 &nbsp;&nbsp;Organismo: 210</h3>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr>
               <th>No</th>
               <th>Partida</th>
               <th style="width: 50%">Descripcion</th>
               <th>Preventivo</th>
             </tr>
             @php $total = 0; @endphp
             @foreach($tabla1 as $row)
             <tr data-id="{{$row->id_preventivo}}">
               <td>{{++$loop->index}}</td>
               <td>{{$row->id_objeto}}</td>
               <td>{{$row->descripcion}}</td>
               <td>{{number_format($row->subtotal, 2)}}</td>
               @php $total += $row->subtotal @endphp
             </tr>
             @endforeach
             <tr>
               <th colspan="3">Total</th>
               <th>{{number_format($total, 2)}}</th>
             </tr>
           </tbody>
         </table>
        </div>
      <!-- /.box-header -->
      </div>
    </div>

    <!-- BAR CHART -->
    <div class="col-md-7">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Distribucion gráfica de datos</h3>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart1" style="height:230px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-7">
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title"></h3>
            <h3 class="box-title">Fuente: 20 &nbsp;&nbsp;Organismo: 230</h3>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr>
               <th>No</th>
               <th>Partida</th>
               <th style="width: 50%">Descripcion</th>
               <th>Preventivo</th>
             </tr>
             @php $total = 0; @endphp
             @foreach($tabla2 as $row)
             <tr data-id="{{$row->id_preventivo}}">
               <td>{{++$loop->index}}</td>
               <td>{{$row->id_objeto}}</td>
               <td>{{$row->descripcion}}</td>
               <td>{{number_format($row->subtotal, 2)}}</td>
               @php $total += $row->subtotal @endphp
             </tr>
             @endforeach
             <tr>
               <th colspan="3">Total</th>
               <th>{{number_format($total, 2)}}</th>
             </tr>
           </tbody>
         </table>
        </div>
      <!-- /.box-header -->
      </div>
    </div>

    <!-- BAR CHART -->
    <div class="col-md-5">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Distribucion gráfica de datos</h3>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart2" style="height:230px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
@endsection

@section('script_barras')
<script>
  $(function () {
    var data1 = @php echo $tabla1 @endphp;
    var partidas1 = [];
    var subtotales1 = [];
    for (var i = 0; i < data1.length; i++) {
      partidas1[i] = data1[i].id_objeto;
      subtotales1[i] = data1[i].subtotal;
    }
    var barChartCanvas1 = $('#barChart1').get(0).getContext('2d')
    var barChart1 = new Chart(barChartCanvas1)
    var areaChartData1 = {
      labels : partidas1,
      datasets: [
        {
          label               : 'Preventivos',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : subtotales1
        }
      ]
    }
    var barChartData1                     = areaChartData1
    barChartData1.datasets[0].fillColor   = '#00a65a'
    barChartData1.datasets[0].strokeColor = '#00a65a'
    barChartData1.datasets[0].pointColor  = '#00a65a'
    var barChartOptions                  = {
      scaleBeginAtZero        : true,
      scaleShowGridLines      : true,
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      scaleGridLineWidth      : 1,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines  : true,
      barShowStroke           : true,
      barStrokeWidth          : 2,
      barValueSpacing         : 5,
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      responsive              : true,
      maintainAspectRatio     : true
    }
    barChartOptions.datasetFill = false
    barChart1.Bar(barChartData1, barChartOptions)

    // Fuente 20, Organismo 230
    var data2 = @php echo $tabla2 @endphp;
    var partidas2 = [];
    var subtotales2 = [];
    for (var i = 0; i < data2.length; i++) {
      partidas2[i] = data2[i].id_objeto;
      subtotales2[i] = data2[i].subtotal;
    }
    var barChartCanvas2 = $('#barChart2').get(0).getContext('2d')
    var barChart2 = new Chart(barChartCanvas2)
    var areaChartData2 = {
      labels : partidas2,
      datasets: [
        {
          label               : 'Preventivos',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : subtotales2
        }
      ]
    }
    var barChartData2                     = areaChartData2
    barChartData2.datasets[0].fillColor   = 'red'
    barChartData2.datasets[0].strokeColor = 'red'
    barChartData2.datasets[0].pointColor  = 'red'
    barChartOptions.datasetFill = false
    barChart2.Bar(barChartData2, barChartOptions)
  })
</script>
@endsection