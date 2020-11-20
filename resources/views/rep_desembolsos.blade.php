@extends('layout')

@section('title', 'ProgramaCovid | Desembolsos')

@section('content-header')
<h1>
  Desembolsos
  <small>Presupuesto asignado por el Ministerio de Economía y Finanzas</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Desembolsos</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="box box-success">
			{{-- <div class="box-header"> --}}
          		{{-- <h3 class="box-title">Fuente: 20 &nbsp;&nbsp;Organismo: 210</h3> --}}
        	{{-- </div> --}}

        	<div class="box-body table-responsive no-padding">
		      	<table class="table table-hover table-striped table-bordered">
		        	<tbody>
		          		<tr>
		           			<th>No</th>
		           			<th>Fuente</th>
		           			<th>Organismo</th>
		           			<th>1er desembolso (Bs)</th>
		           			<th>Porcentaje (%)</th>
		           			<th>2do y 3er desembolsos (Bs)</th>
		           			<th>Porcentaje (%)</th>
		           			<th>Total</th>
		       			</tr>
						@foreach($org as $row)
		       			<tr>
		       				<td>{{$loop->iteration}}</td>
		       				<td>{{$row->fuente}}</td>
		       				<td>{{$row->organismo}}</td>
		       				<td class="right">{{number_format($row->desem_1, 2)}}</td>
		       <td class="right">{{$row->porc_1}}</td>
		       				<td class="right">{{number_format($row->desem_23, 2)}}</td>
		       <td class="right">{{$row->porc_23}}</td>
<td class="right">{{number_format(($row->total), 2)}}</td>
		       			</tr>
						@endforeach			       			
		       		</tbody>
		   		</table>
			</div>
		</div>
	</div>
</div>
@endsection