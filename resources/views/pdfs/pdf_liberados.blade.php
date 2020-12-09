<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Por liberar</title>
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
	<link rel="stylesheet" href="{{asset('scripts/css/pdf.css')}}">
	<style type="text/css">


	</style>
</head>
<body>
	<main>
		<h3 class="title-pdf">Preventivos por liberar</h3>
		<div class="params">
			<table width="100%">
				@isset($fuente)
				<tr>
					<th style="width: 2.5cm;">Fuente</th>
					<td>{{$fuente." ".getFuentes()[$fuente]}}</td>
					<th style="text-align: right;">Fecha</th>
					<td style="text-align: right;  width: 2cm;">{{date('d/m/Y')}}</td>
				</tr>
				@endisset
				@isset($organismo)
				<tr>
					<th>Organismo</th>
					<td>{{$organismo." ".getOrganismos()[$organismo]}}</td>
					<th style="text-align: right;">Hora</th>
					<td style="text-align: right;">{{date('h:i:s A', time())}}</td>
					{{-- <td>{{localtime()}}</td> --}}
				</tr>
				@endisset
				@isset($partida)
				<tr>
					<th>Partida</th>
					<td>{{$id_partida}} {{$partida}}</td>
				</tr>
				@endisset
				@isset($tipo)
				<tr>
					<th>Tipo</th>
					<td>{{$tipo}}</td>
				</tr>
				@endisset
			</table>
		</div>

		<table class="table-bordered table-datos">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nro Prev</th>
					<th>Detalle (Glosa)</th>					
					<th>Fecha elab</th>
					<th>Fte/Org</th>
					<th>Partida</th>
					<th>Ubicacion</th>
					<th>Progreso</th>
					<th>Estado</th>
					<th>Preventivo (Bs)</th>
					<th>Devengado (Bs)</th>
					<th>Por liberar (Bs)</th>
				</tr>
			</thead>
			<tbody>
				@php 
				$total_preventivo = 0; 
				$total_devengado = 0; 
				$total_porliberar = 0; 
				@endphp
				@foreach($reg as $row)
				<tr data-id="{{$row->id_preventivo}}">
					<td>{{$loop->iteration}}</td>
					<td>{{$row->preventivo}}</td>
					<td style="text-align: left;" width="40%">{{$row->glosa}}</td>
					@php 
						$total_preventivo += $row->importe; 
						$total_devengado += $row->pagado; 
						$total_porliberar += $row->importe - $row->pagado; 
					@endphp
					<td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
					<td>{{$row->fuente}}-{{$row->organismo}}</td>
					<td>{{$row->id_objeto}}</td>
					<td style="text-align: left;">{{$row->ubicacion}}</td>
					<td>
					@if (!is_null($row->porcent))
					{{$row->porcent}}%
					@endif
					</td>
					<td style="text-align: left;">{{$row->estado}}</td>
					<td style="text-align: right;">{{number_format($row->importe, 2)}}</td>
					<td style="text-align: right;">{{number_format($row->pagado, 2)}}</td>
					<td style="text-align: right;">{{number_format($row->importe - $row->pagado, 2)}}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="9">TOTAL</td>
					<td style="text-align: right;">{{number_format($total_preventivo, 2)}}</td>
					<td style="text-align: right;">{{number_format($total_devengado, 2)}}</td>
					<td style="text-align: right;">{{number_format($total_porliberar, 2)}}</td>
				</tr>
			</tfoot>
		</table>
	</main>
</body>
</html>