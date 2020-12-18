<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{-- <link rel="stylesheet" href="{{config('app.url')}}/bower_components/bootstrap/dist/css/bootstrap.min.css"> --}}
	{{-- <link rel="stylesheet" href="{{config('app.url')}}/bower_components/font-awesome/css/font-awesome.min.css"> --}}
	
	<title>Lista de Preventivos</title>
	<link rel="stylesheet" href="{{asset('scripts/css/pdf.css')}}">
	<style type="text/css">
	</style>
</head>
<body>
	<main style="margin: 15px;">
		<h3 class="title-pdf">LISTA DE PREVENTIVOS</h3>
		<h5 style="text-align: center; margin-top: 0px;">(Montos expresados en Bolivianos)</h5>
		<div class="params">
			<table width="100%">
				@isset ($fuente)
				<tr>
					<th style="width: 2.5cm;">Fuente</th>
					<td>{{$fuente." ".getFuentes()[$fuente]}}</td>
					<th style="text-align: right;">Fecha</th>
					<td style="text-align: right;  width: 2cm;">{{date('d/m/Y')}}</td>
				</tr>
				@endisset
				@isset ($organismo)
				<tr>
					<th style="width: 2.5cm;">Organismo</th>
					<td>{{$organismo." ".getOrganismos()[$organismo]}}</td>
					<th style="text-align: right;">Hora</th>
					<td style="text-align: right;">{{date('h:i:s A', time())}}</td>
				</tr>
				@endisset
				@isset ($id_partida)
				<tr>
					<th style="width: 2.5cm;">Partida</th>
					<td>{{$id_partida}} {{$partida}}</td>
				</tr>
				@endisset
				@isset ($tipo)
				<tr>
					<th style="width: 2.5cm;">Tipo</th>
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
					<th>Partida</th>
					<th>Preventivo <br>(Bs)</th>
					<th>Devengado <br>(Bs)</th>
					<th>Pagado <br>(Bs)</th>
					<th>Tipo</th>
					{{-- <th>Partida</th> --}}
					<th>Estado</th>
					<th>Desembolso</th>
					<th>Progreso</th>
				</tr>
			</thead>
			<tbody>
				@php $total = 0; $colspan = 12; $totdev = 0; $totpag = 0;
					$total_fuente = 0; $total_organismo = 0;
					$totdev_fuente = 0; $totdev_organismo = 0;
					$totpag_fuente = 0; $totpag_organismo = 0;
				@endphp
				@foreach($reg as $row)
					@if($loop->first)
					@php 
						$reg_fuente = $row->fuente;
						$reg_organismo = $row->organismo;
					@endphp
					<tr>
						<td  colspan="{{$colspan}}" style="text-align: left;">
							<strong>{{"FUENTE: ".$reg_fuente." ".getFuentes()[$reg_fuente]}}</strong>
						</td>
					</tr>
					<tr>
						<td  colspan="{{$colspan}}" style="text-align: left;">
							<strong>{{"ORGANISMO: ".$reg_organismo." ".getOrganismos()[$reg_organismo]}}
						</td>
					</tr>
					@endif					

					@if(($row->organismo <> $reg_organismo))
					<tr style="background-color: lightgray;">
						<td colspan="5" style="text-align: left;"><strong>TOTAL ORGANISMO: {{$reg_organismo}}</strong></td>
						<td style="text-align: right;"><strong>{{number_format($total_organismo, 2)}}</strong></td>
						<td style="text-align: right;"><strong>{{number_format($totdev_organismo, 2)}}</strong></td>
						<td style="text-align: right;"><strong>{{number_format($totpag_organismo, 2)}}</strong></td>
						<td colspan="8"></td>
					</tr>
					@php 
						$reg_organismo = $row->organismo;
						$total_organismo = 0;
						$totdev_organismo = 0;
						$totpag_organismo = 0;
					@endphp
					@if($row->fuente <> $reg_fuente)
					<tr style="background-color: lightgray;">
						<td colspan="5" style="text-align: left;"><strong>TOTAL FUENTE: {{$reg_fuente}}</strong></td>
						<td style="text-align: right;"><strong>{{number_format($total_fuente, 2)}}</strong></td>
						<td style="text-align: right;"><strong>{{number_format($totdev_fuente, 2)}}</strong></td>
						<td style="text-align: right;"><strong>{{number_format($totpag_fuente, 2)}}</strong></td>
						<td colspan="8"></td>
					</tr>
					@php 
						$reg_fuente = $row->fuente;
						$total_fuente = 0;
						$totdev_fuente = 0;
						$totpag_fuente = 0;
					@endphp
					<tr>
						<td  colspan="{{$colspan}}" style="text-align: left;">
							<strong>{{"FUENTE: ".$reg_fuente." ".getFuentes()[$reg_fuente]}}</strong>
						</td>
					</tr>
					@endif
					<tr>
						<td  colspan="{{$colspan}}" style="text-align: left;">
							<strong>{{"ORGANISMO: ".$reg_organismo." ".getOrganismos()[$reg_organismo]}}</strong>
						</td>
					</tr>
					@endif
				<tr data-id="{{$row->id_preventivo}}">
					<td>{{$loop->iteration}}</td>
					<td>{{$row->preventivo}}</td>
					<td style="text-align: left;" width="40%">{{$row->glosa}}</td>
					<td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
					<td>{{$row->id_objeto}}</td>
					<td style="text-align: right;">{{number_format($row->importe, 2)}}</td>
					<td style="text-align: right;">{{number_format($row->pagado, 2)}}</td>
					<td style="text-align: right;">{{number_format($row->cancelado, 2)}}</td>
					@php 
						$total += $row->importe; 
						$totdev += $row->pagado; 
						$totpag += $row->cancelado; 
						$total_fuente += $row->importe;
						$totdev_fuente += $row->pagado;
						$totpag_fuente += $row->cancelado;
						$total_organismo += $row->importe;
						$totdev_organismo += $row->pagado;
						$totpag_organismo += $row->cancelado;
					@endphp
					
					{{-- <td>{{$row->fuente}}-{{$row->organismo}}</td> --}}
					<td>{{$row->tipo}}</td>
					{{-- <td style="text-align: left;" width="20%">{{(is_null($row->observaciones)) ? 'NINGUNO': $row->observaciones}}</td> --}}
					<td>{{$row->estado}}</td>
					<td>{{$row->desembolso}}</td>
					<td>
					@if (!is_null($row->porcent))
					{{$row->porcent}}%
					@endif
					</td>
				</tr>				
				@endforeach
				<tr style="background-color: lightgray;">
					<td colspan="5" style="text-align: left;"><strong>TOTAL ORGANISMO: {{$reg_organismo}}</strong></td>
					<td style="text-align: right;"><strong>{{number_format($total_organismo, 2)}}</strong></td>
					<td style="text-align: right;"><strong>{{number_format($totdev_organismo, 2)}}</strong></td>
					<td style="text-align: right;"><strong>{{number_format($totpag_organismo, 2)}}</strong></td>
					<td colspan="8"></td>
				</tr>
				<tr style="background-color: lightgray;">
					<td colspan="5" style="text-align: left;"><strong>TOTAL FUENTE: {{$reg_fuente}}</strong></td>
					<td style="text-align: right;"><strong>{{number_format($total_fuente, 2)}}</strong></td>
					<td style="text-align: right;"><strong>{{number_format($totdev_fuente, 2)}}</strong></td>
					<td style="text-align: right;"><strong>{{number_format($totpag_fuente, 2)}}</strong></td>
					<td colspan="8"></td>
				</tr>

				<tr style="background-color: lightgray;">
					<td colspan="5" style="text-align: left;"><strong>TOTAL GENERAL</strong></td>
					<td style="text-align: right;"><strong>{{number_format($total, 2)}}</strong></td>
					<td style="text-align: right;"><strong>{{number_format($totdev, 2)}}</strong></td>
					<td style="text-align: right;"><strong>{{number_format($totpag, 2)}}</strong></td>
					<td colspan="8"></td>
				</tr>
			</tbody>
		</table>
	</main>
</body>
</html>