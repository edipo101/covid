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
		<h3 class="title-pdf">Ejecucion presupuestaria</h3>
		<h5 class="title-pdf" style="margin-top: 3px;">(Montos expresados en Bolivianos)</h5>
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
					<th>Aprobado (A)</th>
					<th>Preventivo (P)</th>
					<th>Devengado (D)</th>
					<th>Saldo aprobado (A-P)</th>
               		<th>Saldo preventivo (P-D)</th>
               		<th>Saldo devengado (A-D)</th>
				</tr>
			</thead>
			<tbody>
				@php 
					$total_aprob = 0;
					$total_preven = 0;
					$total_pagado = 0;
					$org = ($fuente == 20) ? 210 : 111;
					$tot_org_aprob = 0;
					$tot_org_preven = 0;
					$tot_org_pagado = 0;
					$total_saldo_aprob = 0; $total_saldo_preven = 0; $total_saldo_deven = 0;
                	$total_org_saldo_aprob = 0; $total_org_saldo_preven = 0; $total_org_saldo_deven = 0;
				@endphp
				@foreach($reg as $row)
					@if ($row->organismo <> $org)
						<tr class="total">
							<td colspan="5" style="text-align: left;">TOTAL ORGANISMO: {{$org}}</td>
							<td style="text-align: right;">{{number_format($tot_org_aprob, 2)}}</td>
							<td style="text-align: right;">{{number_format($tot_org_preven, 2)}}</td>
							<td style="text-align: right;">{{number_format($tot_org_pagado, 2)}}</td>
							<td style="text-align: right;">{{number_format($total_org_saldo_aprob, 2)}}</td>
		                    <td style="text-align: right;">{{number_format($total_org_saldo_preven, 2)}}</td>
		                    <td style="text-align: right;">{{number_format($total_org_saldo_deven, 2)}}</td>
						</tr>
						@php 
							$org = $row->organismo; 
							$tot_org_aprob = 0;
							$tot_org_preven = 0;
							$tot_org_pagado = 0;
							$total_org_aprob = 0; $total_org_preven = 0; $total_org_pagado = 0;
                    		$total_org_saldo_aprob = 0; $total_org_saldo_preven = 0; $total_org_saldo_deven = 0;
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
							$total_saldo_aprob += $row->saldo_aprob;
			                $total_saldo_preven += $row->saldo_preven;
			                $total_saldo_deven += $row->saldo_deven;
			                $total_org_saldo_aprob += $row->saldo_aprob;
			                $total_org_saldo_preven += $row->saldo_preven;
			                $total_org_saldo_deven += $row->saldo_deven;
						@endphp
						<td style="text-align: right;">{{number_format($row->monto_aprob, 2)}}</td>
						<td style="text-align: right;">{{number_format($row->monto_preven, 2)}}</td>
						<td style="text-align: right;">{{number_format($row->monto_pagado, 2)}}</td>
						<td style="text-align: right;">{{number_format($row->saldo_aprob, 2)}}</td>
						<td style="text-align: right;">{{number_format($row->saldo_preven, 2)}}</td>
						<td style="text-align: right;">{{number_format($row->saldo_deven, 2)}}</td>
					</tr>

					@if (!isset($organismo) && $loop->last))
						<tr class="total">
							<td colspan="5" style="text-align: left;">TOTAL ORGANISMO: {{$org}}</td>
							<td style="text-align: right;">{{number_format($tot_org_aprob, 2)}}</td>
							<td style="text-align: right;">{{number_format($tot_org_preven, 2)}}</td>
							<td style="text-align: right;">{{number_format($tot_org_pagado, 2)}}</td>
							<td style="text-align: right;">{{number_format($total_org_saldo_aprob, 2)}}</td>
                    		<td style="text-align: right;">{{number_format($total_org_saldo_preven, 2)}}</td>
                    		<td style="text-align: right;">{{number_format($total_org_saldo_deven, 2)}}</td>
						</tr>
					@endif
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5">TOTAL</td>
					<td style="text-align: right;">{{number_format($total_aprob, 2)}}</td>
					<td style="text-align: right;">{{number_format($total_preven, 2)}}</td>
					<td style="text-align: right;">{{number_format($total_pagado, 2)}}</td>
					<td style="text-align: right;">{{number_format($total_saldo_aprob, 2)}}</td>
                	<td style="text-align: right;">{{number_format($total_saldo_preven, 2)}}</td>
                	<td style="text-align: right;">{{number_format($total_saldo_deven, 2)}}</td>
				</tr>
			</tfoot>
		</table>
	</main>
</body>
</html>