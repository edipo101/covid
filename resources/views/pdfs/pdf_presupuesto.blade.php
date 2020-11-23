<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Presupuesto</title>
	<link rel="stylesheet" href="{{asset('scripts/css/pdf.css')}}">
	<style type="text/css">


	</style>
</head>
<body>
	<main>
		<h3 class="title-pdf">Presupuesto</h3>
		<div class="params">
			<table width="100%">
				<tr>
					<th style="width: 2.5cm;">Fuente</th>
					<td>{{$fuente." ".getFuentes()[$fuente]}}</td>
					<th style="text-align: right;">Fecha y Hora</th>
					<td style="text-align: right;  width: 4cm;">{{date('d/m/Y')}} {{date('h:i:s A', time())}}</td>
				</tr>
				@isset($organismo)
				<tr>
					<th>Organismo</th>
					<td>{{$organismo." ".getOrganismos()[$organismo]}}</td>
				</tr>
				@endisset				
			</table>
		</div>

		<table class="table-bordered table-datos" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Fuente</th>
					<th>Organismo</th>
					<th>Partida</th>
					<th>Descripcion</th>
					<th>Aprobado (Bs)</th>
					<th>Preventivo (Bs)</th>
					<th>Devengado (Bs)</th>
				</tr>
			</thead>
			<tbody>
				@php 
					$total_aprob = 0;
					$total_preven = 0;
					$total_pagado = 0;
					// $fuente = 20;
					$org = ($fuente == 20) ? 210 : 111;
					$tot_org_aprob = 0;
					$tot_org_preven = 0;
					$tot_org_pagado = 0;
				@endphp
				@foreach($reg as $row)
					@if ($row->organismo <> $org)
						<tr class="total">
							<td colspan="5" style="text-align: left;">TOTAL ORGANISMO: {{$org}}</td>
							<td style="text-align: right;">{{number_format($tot_org_aprob, 2)}}</td>
							<td style="text-align: right;">{{number_format($tot_org_preven, 2)}}</td>
							<td style="text-align: right;">{{number_format($tot_org_pagado, 2)}}</td>
						</tr>
						@php 
							$org = $row->organismo; 
							$tot_org_aprob = 0;
							$tot_org_preven = 0;
							$tot_org_pagado = 0;
						@endphp
					@endif

					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{$row->fuente}}</td>
						<td>{{$row->organismo}}</td>
						<td>{{$row->partida}}</td>
						<td style="text-align: left;">{{$row->descripcion}}</td>
						@php 
							$total_aprob += $row->monto_aprob; 
							$total_preven += $row->monto_preven; 
							$total_pagado += $row->monto_pagado; 
							$tot_org_aprob += $row->monto_aprob;
							$tot_org_preven += $row->monto_preven;
							$tot_org_pagado += $row->monto_pagado;
						@endphp
						<td style="text-align: right;">{{number_format($row->monto_aprob, 2)}}</td>
						<td style="text-align: right;">{{number_format($row->monto_preven, 2)}}</td>
						<td style="text-align: right;">{{number_format($row->monto_pagado, 2)}}</td>
					</tr>

					@if (!isset($organismo) && $loop->last))
						<tr class="total">
							<td colspan="5" style="text-align: left;">TOTAL ORGANISMO: {{$org}}</td>
							<td style="text-align: right;">{{number_format($tot_org_aprob, 2)}}</td>
							<td style="text-align: right;">{{number_format($tot_org_preven, 2)}}</td>
							<td style="text-align: right;">{{number_format($tot_org_pagado, 2)}}</td>
						</tr>
					@endif
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5">TOTAL GENERAL</td>
					<td style="text-align: right;">{{number_format($total_aprob, 2)}}</td>
					<td style="text-align: right;">{{number_format($total_preven, 2)}}</td>
					<td style="text-align: right;">{{number_format($total_pagado, 2)}}</td>
				</tr>
			</tfoot>
		</table>
	</main>
</body>
</html>