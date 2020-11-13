@extends('layout')

@section('title', 'ProgramaCovid | Principal')

@section('content-header')
<h1>
  Principal
  <small>Panel de control</small>
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

	          <p>New Orders</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-bag"></i>
	        </div>
	        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>
	    <!-- ./col -->
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-green">
	        <div class="inner">
	          <h3>53<sup style="font-size: 20px">%</sup></h3>

	          <p>Bounce Rate</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-stats-bars"></i>
	        </div>
	        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>
	    <!-- ./col -->
	    <div class="col-lg-3 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-yellow">
	        <div class="inner">
	          <h3>44</h3>

	          <p>User Registrations</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-person-add"></i>
	        </div>
	        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
	        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div>
	    <!-- ./col -->
	  </div>

	<div class="row">
	    <div class="col-md-6">
	      <div class="box box-success">
	        <div class="box-header">
	          <h3 class="box-title"></h3>
	          	<h3 class="box-title">Ejecucion presupuestaria (Resumen)</h3>
	        </div>
	        <div class="box-body table-responsive no-padding">
	          <table class="table table-hover table-striped table-bordered">
	            <tbody>
	             	<tr>
		               <th>No.</th>
		               <th>Fuente</th>
		               <th>Organismo</th>
		               <th>Cantidad</th>
		               <th>Preventivo (Bs)</th>
		               <th>Devengado (Bs)</th>
		               <th>Liberado (Bs)</th>
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
	            		<td class="right">{{$row->cant}}</td>
	            		<td class="right">{{number_format($row->imp_preven, 2)}}</td>
	            		<td class="right">{{number_format($row->imp_deven, 2)}}</td>
	            		<td class="right">{{number_format($row->liberado, 2)}}</td>
	            	</tr>
	            	@endforeach
	            	<tr>
	               		<th colspan="4">Total</th>
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
	        <div class="box-header with-border">
	          <h3 class="box-title">Distribucion gráfica de datos</h3>
	        </div>
	        <div class="box-body">
	          <div class="chart">
	            <canvas id="barChart1" style="height: 229px; width: 603px;" height="229" width="603"></canvas>
	          </div>
	        </div>
	        <!-- /.box-body -->
	      </div>
	    </div>
  	</div>

  	<div class="row">
	    <div class="col-md-8">
	      <div class="box box-success">
	        <div class="box-header">
	          <h3 class="box-title"></h3>
	          	<h3 class="box-title">Por Secretarias (Resumen)</h3>
	        </div>
	        <div class="box-body table-responsive no-padding">
	          <table class="table table-hover table-striped table-bordered">
	            <tbody>
	             	<tr>
		               <th>No.</th>
		               <th>Sigla</th>
		               <th>Secretaria</th>
		               {{-- <th>Unidad</th> --}}
		               <th>Cantidad</th>
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
	            		<td>{{$row->cant}}</td>
	            		<td>{{number_format($row->total, 2)}}</td>
	            	</tr>
	            	@endforeach
	            	<tr>
	               		<th colspan="4">Total</th>
	               		<th>{{number_format($total, 2)}}</th>
	             	</tr>
	           </tbody>
	         </table>
	        </div>
	      <!-- /.box-header -->
	      </div>
	    </div>

	    <!-- BAR CHART -->
	    <div class="col-md-4">
	      <div class="box box-success">
	        <div class="box-header with-border">
	          <h3 class="box-title">Distribucion gráfica de datos</h3>
	        </div>
	        <div class="box-body">
	          <div class="chart">
	            <canvas id="barChart1" style="height: 229px; width: 603px;" height="229" width="603"></canvas>
	          </div>
	        </div>
	        <!-- /.box-body -->
	      </div>
	    </div>
  	</div>
@endsection