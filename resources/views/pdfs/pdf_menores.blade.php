<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Compras menores</title>
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
	<link rel="stylesheet" href="{{asset('scripts/css/pdf.css')}}">
	<style type="text/css">

		
	</style>
</head>
<body>
	<main>
		<h3 class="title-pdf">Compras menores</h3>
		<div class="params">
			@php 
				$array_fuente = array(
					20 => 'RECURSOS ESPECIFICOS',
					41 => 'TRANSFERENCIAS T.G.N.'
				);
				$array_org = array(
					210 => 'RECURSOS ESPECIFICOS DE LOS GOBIERNOS AUTONOMOS MUNICIPALES',
					230 => 'OTROS RECURSOS ESPECIFICOS',
					111 => 'TESORO GENERA DE LA NACION',
					113 => 'TESORO GENERA DE LA NACION - COPARTICIPACION TRIBUTARIA',
					119 => 'TESORO GENERA DE LA NACION - IMPUESTO DIRECTO A LOS HIDROCARBUROS',
				);
			@endphp
			<strong>Fuente: </strong>{{$fuente}} {{$array_fuente[$fuente]}}<br>
			<strong>Organismo: </strong>{{$organismo}} {{$array_org[$organismo]}}<br>
			<strong>Partida: </strong>{{$id_partida}} {{$partida}} <br>
			<strong>Ubicacion: </strong>{{$ubicacion}}
		</div>
		<table class="table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nro Prev</th>
					<th>Detalle (Glosa)</th>
					<th>Importe (Bs)</th>
					<th>Fecha elab</th>
					<th>Fte-Org</th>
					<th>Partida</th>
					<th>Ubicacion</th>
					<th>Progreso</th>
				</tr>		
			</thead>
			<tbody>
				@php $total = 0; @endphp
				@foreach($reg as $row)
				<tr data-id="{{$row->id_preventivo}}">
					<td>{{$loop->iteration}}</td>
					<td>{{$row->preventivo}}</td>
					<td style="text-align: left;" width="50%">{{$row->glosa}}</td>
					<td style="text-align: right;">{{number_format($row->importe, 2)}}</td>
					@php $total += $row->importe; @endphp
					<td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
					<td>{{$row->fuente}}-{{$row->organismo}}</td>
					<td>{{$row->id_objeto}}</td>
					<td style="text-align: left;">{{$row->ubicacion}}</td>
					<td>
					@if (!is_null($row->porcent))
					{{$row->porcent}}%
					@endif
					</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">Total</td>
					<td style="text-align: right;">{{number_format($total, 2)}}</td>
				</tr>
			</tfoot>
		</table>
	</main>
</body>
</html>