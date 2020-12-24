@extends('layout')

@section('title', 'ProgramaCovid | Desembolsos')

@section('content-header')
<h1>
  Cuadro resumen de Ejecución Presupuestaria
  <small>Al {{date('d/m/Y')}}</small>
</h1>
<ol class="breadcrumb">
  <li><a href=""><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active">Desembolsos</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
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
		           			<th>Org</th>
		           			{{-- <th>Descripcion</th> --}}
		           			<th>Presupuesto</th>
		           			<th>Recursos ejecutados</th>
		           			<th>Recursos no ejecutados</th>
		           			<th>Compras cerradas</th>
		           			<th>Compras por cerrar</th>
		           			<th>Compras canceladas</th>
		           			<th>Compras cerradas (%)</th>
		           			<th>Compras por cerrar (%)</th>
		           			<th>Compras subtotal (%)</th>
		           			<th>No ejecutados (%)</th>
		           			<th>Total (%)</th>
		       			</tr>
						@foreach($org as $row)
		       			<tr>
		       				<td>{{$loop->iteration}}</td>
		       				<td>{{$row->fuente}}</td>
		       				<td>{{$row->organismo}}</td>
		       				{{-- <td>{{$row->nombre}}</td> --}}
		       				<td class="right">{{number_format($row->presup_vig, 2)}}</td>
		       				<td class="right">{{number_format($row->rec_ejec, 2)}}</td>
									<td class="right">{{number_format(($row->rec_noejec), 2)}}</td>
									<td class="right">{{number_format(($row->comp_cerr), 2)}}</td>
									<td class="right">{{number_format(($row->comp_enproc), 2)}}</td>
									<td class="right">{{number_format(($row->pagado), 2)}}</td>
									<td class="right">{{number_format(($row->porc_comp_cerr), 2)}}</td>
									<td class="right">{{number_format(($row->porc_comp_enproc), 2)}}</td>
									<td class="right">{{number_format(($row->porc_comp_tot), 2)}}</td>
									<td class="right">{{number_format(($row->porc_re_noejec), 2)}}</td>
									<td class="right">{{number_format(($row->porc_total), 2)}}</td>
		       			</tr>
						@endforeach			       			
		       		</tbody>
		   		</table>
			</div>
		</div>
	</div>
</div>
@endsection