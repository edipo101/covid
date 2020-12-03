@extends('layout')

@section('title', 'ProgramaCovid | Principal')

@section('content-header')
<h1>
	Principal
</h1>
<ol class="breadcrumb">
	<li class="active"><i class="fa fa-dashboard"></i> Inicio</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>150</h3>
				<p>Preventivos</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>
			<a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>53<sup style="font-size: 20px">%</sup></h3>
				<p>Ejecución presupuestaria</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>44</h3>
				<p>Liberados</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>65</h3>

				<p>Unique Visitors</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
</div>

<h2 class="page-header">Ejecución presupuestaria</h2>
<div class="row">
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover table-striped table-bordered">
					<tbody>
						<tr>
							<th>No.</th>
							<th>Fuente</th>
							<th>Organismo</th>
							<th style="text-align: center;">Preventivo<br>(Bs)</th>
							<th style="text-align: center;">Devengado<br>(Bs)</th>
							<th style="text-align: center;">Liberado<br>(Bs)</th>
						</tr>
						@php $total_preven = 0; $total_deven = 0; $total_liberado = 0; @endphp
						@foreach($preven as $row)
						@php
						$total_preven += $row->imp_preven;
						$total_deven += $row->imp_deven;
						$total_liberado += $row->liberado;
						@endphp
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$row->fuente}}</td>
							<td>{{$row->organismo}}</td>
							<td class="right">{{number_format($row->imp_preven, 2)}}</td>
							<td class="right">{{number_format($row->imp_deven, 2)}}</td>
							<td class="right">{{number_format($row->liberado, 2)}}</td>
						</tr>
						@endforeach
						<tr>
							<th colspan="3">Total</th>
							<th class="right">{{number_format($total_preven, 2)}}</th>
							<th class="right">{{number_format($total_deven, 2)}}</th>
							<th class="right">{{number_format($total_liberado, 2)}}</th>
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
			<div class="box-body">
				<div class="chart">
					<canvas id="barChart1" style="height: 229px; width: 603px;" height="229" width="603"></canvas>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</div>

<h2 class="page-header">Preventivos por secretarias</h2>
<div class="row">
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover table-striped table-bordered">
					<tbody>
						<tr>
							<th>No.</th>
							<th>Sigla</th>
							<th>Secretaria</th>
							<th>Subtotal (Bs)</th>
						</tr>
						@php $total = 0; @endphp
						@foreach($sec_unid as $row)
						@php $total += $row->total; @endphp
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$row->sigla}}</td>
							<td>{{(!is_null($row->secretaria)) ? $row->secretaria : "(SIN DESIGNACION)"}}</td>
							{{-- <td>{{$row->unidad}}</td> --}}
							<td style="text-align: right;">{{number_format($row->total, 2)}}</td>
						</tr>
						@endforeach
						<tr>
							<th colspan="3">Total</th>
							<th style="text-align: right;">{{number_format($total, 2)}}</th>
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
			<div class="box-body">
				<div class="chart">
					<canvas id="barChart2" height="550" width="603"></canvas>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</div>
@endsection

@section('javascript')
<script src="{{asset('/scripts/js/dashboard.js')}}"></script>
<script type="text/javascript">
	var clabels = {{$preven->pluck('organismo')}};
	var col1 = {{$preven->pluck('imp_preven')}};
	var col2 = {{$preven->pluck('imp_deven')}};
	var col3 = {{$preven->pluck('liberado')}};
	var labels = ['Preventivo', 'Devengado', 'Liberado'];
	var colors = ['green', 'rgba(88, 214, 141)', 'rgba(210, 214, 222, 1)'];
	var barChart = $('#barChart1');
	showChart3(clabels, col1, col2, col3, barChart, labels, colors);

	clabels = {!!$sec_unid->pluck('sigla')!!};
	col1 = {{$sec_unid->pluck('total')}};
	colors = ['purple'];
	barChart = $('#barChart2');
	showChart(clabels, col1, barChart, colors);

</script>
@endsection