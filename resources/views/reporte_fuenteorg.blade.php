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
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Fuente: 20 &nbsp;&nbsp;Organismo: 210</h3>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr>
               <th>No</th>
               <th>Partida</th>
               <th style="width: 50%">Descripcion</th>
               <th style="text-align: center">Preventivo (Bs)</th>
               <th style="text-align: center">Devengado (Bs)</th>
             </tr>
             @php $total = 0; $tot_deven = 0; @endphp
             @foreach($tabla1 as $row)
             <tr data-id="{{$row->id_preventivo}}">
               <td>{{$loop->iteration}}</td>
               <td><strong>{{$row->id_objeto}}</strong></td>
               <td>{{$row->descripcion}}</td>
               <td class="right">{{number_format($row->importe, 2)}}</td>
               <td class="right">{{number_format($row->pagado, 2)}}</td>
               @php $total += $row->importe; $tot_deven += $row->pagado @endphp
             </tr>
             @endforeach
             <tr>
               <th colspan="3">Total</th>
               <th>{{number_format($total, 2)}}</th>
               <th>{{number_format($tot_deven, 2)}}</th>
             </tr>
           </tbody>
         </table>
        </div>
      <!-- /.box-header -->
      </div>
    </div>

    <!-- BAR CHART -->
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Distribucion gráfica de datos</h3>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart1" style="height:330px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>

    </div>
  </div>

  {{-- Fuente 20, Organismo 230 --}}
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
               <th style="text-align: center">Preventivo (Bs)</th>
               <th style="text-align: center">Devengado (Bs)</th>
             </tr>
             @php $total = 0; $deven = 0; @endphp
             @foreach($tabla2 as $row)
             <tr data-id="{{$row->id_preventivo}}">
               <td>{{++$loop->index}}</td>
               <td>{{$row->id_objeto}}</td>
               <td>{{$row->descripcion}}</td>
               <td class="right">{{number_format($row->importe, 2)}}</td>
               <td class="right">{{number_format($row->pagado, 2)}}</td>
               @php $total += $row->importe; $deven += $row->pagado; @endphp
             </tr>
             @endforeach
             <tr>
               <th colspan="3">Total</th>
               <th class="right">{{number_format($total, 2)}}</th>
               <th class="right">{{number_format($deven, 2)}}</th>
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

  {{-- Fuente 41, Organismo 111 --}}
  <div class="row">
    <div class="col-md-7">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title"></h3>
            <h3 class="box-title">Fuente: 41 &nbsp;&nbsp;Organismo: 111</h3>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr>
               <th>No</th>
               <th>Partida</th>
               <th style="width: 50%">Descripcion</th>
               <th style="text-align: center">Preventivo (Bs)</th>
               <th style="text-align: center">Devengado (Bs)</th>
             </tr>
             @php $total = 0; $deven = 0; @endphp
             @foreach($tabla3 as $row)
             <tr data-id="{{$row->id_preventivo}}">
               <td>{{++$loop->index}}</td>
               <td>{{$row->id_objeto}}</td>
               <td>{{$row->descripcion}}</td>
               <td class="right">{{number_format($row->importe, 2)}}</td>
               <td class="right">{{number_format($row->pagado, 2)}}</td>
               @php $total += $row->importe; $deven += $row->pagado; @endphp
             </tr>
             @endforeach
             <tr>
               <th colspan="3">Total</th>
               <th class="right">{{number_format($total, 2)}}</th>
               <th class="right">{{number_format($deven, 2)}}</th>
             </tr>
           </tbody>
         </table>
        </div>
      <!-- /.box-header -->
      </div>
    </div>        
  </div>

  {{-- Fuente 41, Organismo 113 --}}
  <div class="row">
    <div class="col-md-8">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title"></h3>
            <h3 class="box-title">Fuente: 41 &nbsp;&nbsp;Organismo: 113</h3>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr>
               <th>No</th>
               <th>Partida</th>
               <th style="width: 50%">Descripcion</th>
               <th style="text-align: center">Preventivo (Bs)</th>
               <th style="text-align: center">Devengado (Bs)</th>
             </tr>
             @php $total = 0; $deven = 0; @endphp
             @foreach($tabla4 as $row)
             <tr data-id="{{$row->id_preventivo}}">
               <td>{{++$loop->index}}</td>
               <td>{{$row->id_objeto}}</td>
               <td>{{$row->descripcion}}</td>
               <td class="right">{{number_format($row->importe, 2)}}</td>
               <td class="right">{{number_format($row->pagado, 2)}}</td>
               @php $total += $row->importe; $deven += $row->pagado; @endphp
             </tr>
             @endforeach
             <tr>
               <th colspan="3">Total</th>
               <th class="right">{{number_format($total, 2)}}</th>
               <th class="right">{{number_format($deven, 2)}}</th>
             </tr>
           </tbody>
         </table>
        </div>
      <!-- /.box-header -->
      </div>
    </div>
  </div>

  <div class="row">
    <!-- BAR CHART -->
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Distribucion gráfica de datos</h3>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart4" style="height:230px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  {{-- Fuente 41, Organismo 119 --}}
  <div class="row">
    <div class="col-md-8">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title"></h3>
            <h3 class="box-title">Fuente: 41 &nbsp;&nbsp;Organismo: 119</h3>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr>
               <th>No</th>
               <th>Partida</th>
               <th style="width: 50%">Descripcion</th>
               <th style="text-align: center">Preventivo (Bs)</th>
               <th style="text-align: center">Devengado (Bs)</th>
             </tr>
             @php $total = 0; $deven = 0; @endphp
             @foreach($tabla5 as $row)
             <tr data-id="{{$row->id_preventivo}}">
               <td>{{++$loop->index}}</td>
               <td>{{$row->id_objeto}}</td>
               <td>{{$row->descripcion}}</td>
               <td class="right">{{number_format($row->importe, 2)}}</td>
               <td class="right">{{number_format($row->pagado, 2)}}</td>
               @php $total += $row->importe; $deven += $row->pagado; @endphp
             </tr>
             @endforeach
             <tr>
               <th colspan="3">Total</th>
               <th class="right">{{number_format($total, 2)}}</th>
               <th class="right">{{number_format($deven, 2)}}</th>
             </tr>
           </tbody>
         </table>
        </div>
      <!-- /.box-header -->
      </div>
    </div>
  </div>

  <div class="row">
    <!-- BAR CHART -->
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Distribucion gráfica de datos</h3>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart5" style="height:230px"></canvas>
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
    var subtot_210 = [];
    var deven_210 = [];

    for (var i = 0; i < data1.length; i++) {
      partidas1[i] = data1[i].id_objeto;
      subtot_210[i] = data1[i].importe;
      deven_210[i] = data1[i].pagado;
    }
    var barChartCanvas1 = $('#barChart1').get(0).getContext('2d')
    var barChart1 = new Chart(barChartCanvas1)
    var areaChartData1 = {
      labels : partidas1,
      datasets: [
        {
          label               : 'Preventivos',
          fillColor           : 'green',
          strokeColor         : 'green',
          data                : subtot_210
        },
        {
          label               : 'Devengados',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          data                : deven_210
        }
      ]
    }
    var barChartData1         = areaChartData1
    var barChartOptions       = {
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
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      responsive              : true,
      maintainAspectRatio     : true
    }
    barChartOptions.datasetFill = false
    barChart1.Bar(barChartData1, barChartOptions)

    // Fuente 20, Organismo 230
    var data2 = @php echo $tabla2 @endphp;
    var part_230 = [];
    var imp_230 = [];
    var deven_230 = [];
    for (var i = 0; i < data2.length; i++) {
      part_230[i] = data2[i].id_objeto;
      imp_230[i] = data2[i].importe;
      deven_230[i] = data2[i].pagado;
    }
    var barChartCanvas2 = $('#barChart2').get(0).getContext('2d')
    var barChart2 = new Chart(barChartCanvas2)
    var areaChartData2 = {
      labels : part_230,
      datasets: [
        {
          label               : 'Preventivo',
          fillColor           : 'red',
          strokeColor         : 'red',
          data                : imp_230
        },
        {
          label               : 'Devengado',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          data                : deven_230
        }
      ]
    }
    var barChartData2 = areaChartData2
    barChart2.Bar(barChartData2, barChartOptions)

    // Fuente 41, Organismo 113
    var data4 = @php echo $tabla4 @endphp;
    var part_113 = [];
    var imp_113 = [];
    var deven_113 = [];
    for (var i = 0; i < data4.length; i++) {
      part_113[i] = data4[i].id_objeto;
      imp_113[i] = data4[i].importe;
      deven_113[i] = data4[i].pagado;
    }
    var barChartCanvas4 = $('#barChart4').get(0).getContext('2d')
    var barChart4 = new Chart(barChartCanvas4)
    var areaChartData4 = {
      labels : part_113,
      datasets: [
        {
          label               : 'Preventivo',
          fillColor           : 'orange',
          strokeColor         : 'orange',
          data                : imp_113
        },
        {
          label               : 'Devengado',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          data                : deven_113
        }
      ]
    }
    var barChartData4 = areaChartData4
    barChart4.Bar(barChartData4, barChartOptions)

    // Fuente 41, Organismo 119
    var data5 = @php echo $tabla5 @endphp;
    var part_119 = [];
    var imp_119 = [];
    var deven_119 = [];
    for (var i = 0; i < data5.length; i++) {
      part_119[i] = data5[i].id_objeto;
      imp_119[i] = data5[i].importe;
      deven_119[i] = data5[i].pagado;
    }
    var barChartCanvas5 = $('#barChart5').get(0).getContext('2d')
    var barChart5 = new Chart(barChartCanvas5)
    var areaChartData5 = {
      labels : part_119,
      datasets: [
        {
          label               : 'Preventivo',
          fillColor           : 'purple',
          strokeColor         : 'purple',
          data                : imp_119
        },
        {
          label               : 'Devengado',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          data                : deven_119
        }
      ]
    }
    var barChartData5 = areaChartData5
    barChart5.Bar(barChartData5, barChartOptions)

  })
</script>
@endsection