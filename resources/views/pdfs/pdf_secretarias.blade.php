<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Por Secretarias</title>
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
	<link rel="stylesheet" href="{{asset('scripts/css/pdf.css')}}">
	<style type="text/css">


	</style>
</head>
<body>
	<main>
		<h3 class="title-pdf">LISTA DE PREVENTIVOS</h3>
		<div class="params" style="margin-bottom: 0px;">
			<div style="display: inline-block;">
				<ul id="title_filter" style="padding-left: 0px;">
					@isset($secretaria)
					<li><span class="title">Secretaria</span> {{$secretaria}}</li>
					<li><span class="title">Unidad</span> {{$unidad}}</li>
					@endisset
					@isset($tipo)
					<li><span class="title">Tipo</span> {{$tipo}}</li>
					<li><span class="title">Ubicacion</span> {{$ubicacion}}</li>
					@endisset
					<li><span class="title">Cant. de registros</span> {{$reg->count()}}</li>
				</ul>
			</div>

			<div style="display: inline; float: right;">
				<strong>Fecha y Hora</strong> {{date('d/m/Y')}} {{date('h:i:s A', time())}}
			</div>
		</div>

		<table class="table-bordered table-datos">
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
					<th>Estado</th>
					<th>Observaciones</th>
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
					<td>{{$row->fuente}}-{{$row->organismo}}</td>
					<td>{{$row->id_objeto}}</td>
					<td>{{$row->ubicacion}}</td>
					<td>
					@if (!is_null($row->porcent))
					{{$row->porcent}}%
					@endif
					</td>
					<td style="text-align: left;">{{$row->estado}}</td>
					<td style="text-align: left;">{{(is_null($row->observaciones)) ? 'NINGUNO': $row->observaciones}}</td>
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