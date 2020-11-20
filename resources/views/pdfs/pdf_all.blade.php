<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Preventivos</title>
	<link rel="stylesheet" href="{{asset('scripts/css/pdf.css')}}">
	<style type="text/css">


	</style>
</head>
<body>
	<main>
		<h3 class="title-pdf">Preventivos filtrados por Fuente, Organismo y Partida</h3>
		<div class="params">
			<table width="100%">
				<tr>
					<th style="width: 2.5cm;">Fuente</th>
					<td>{{$fuente." ".getFuentes()[$fuente]}}</td>
					<th style="text-align: right;">Fecha</th>
					<td style="text-align: right;  width: 2cm;">{{date('d/m/Y')}}</td>
				</tr>
				<tr>
					<th>Organismo</th>
					<td>{{$organismo." ".getOrganismos()[$organismo]}}</td>
					<th style="text-align: right;">Hora</th>
					<td style="text-align: right;">{{date('h:i:s A', time())}}</td>
				</tr>
				<tr>
					<th>Partida</th>
					<td>{{$id_partida}} {{$partida}}</td>
				</tr>
				@isset ($tipo)
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
					<th>Importe (Bs)</th>
					<th>Fecha elab</th>
					<th>Tipo</th>
					{{-- <th>Partida</th> --}}
					<th>Observaciones</th>
					<th>Progreso</th>
				</tr>
			</thead>
			<tbody>
				@php $total = 0; @endphp
				@foreach($reg as $row)
				<tr data-id="{{$row->id_preventivo}}">
					<td>{{$loop->iteration}}</td>
					<td>{{$row->preventivo}}</td>
					<td style="text-align: left;" width="40%">{{$row->glosa}}</td>
					<td style="text-align: right;">{{number_format($row->importe, 2)}}</td>
					@php $total += $row->importe; @endphp
					<td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
					{{-- <td>{{$row->fuente}}-{{$row->organismo}}</td> --}}
					<td>{{$row->tipo}}</td>
					<td style="text-align: left;" width="20%">{{(is_null($row->observaciones)) ? 'NINGUNO': $row->observaciones}}</td>
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
					<td colspan="3">TOTAL</td>
					<td style="text-align: right;">{{number_format($total, 2)}}</td>
				</tr>
			</tfoot>
		</table>
	</main>
</body>
</html>