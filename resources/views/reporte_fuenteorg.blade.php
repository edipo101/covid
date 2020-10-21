<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<pre>
		<table>
			<tr>
				<th>Fuente</th>
				<th>Organismo</th>
				<th>Partida</th>
				<th>Cantidad</th>
				<th>Total</th>
			</tr>
			@php
				$cant = 0;
				$total = 0;
			@endphp
			@foreach($report as $row)
			<tr>
				<td>{{$row->fuente}}</td>
				<td>{{$row->organismo}}</td>
				<td>{{$row->id_objeto}}</td>
				<td>{{$row->cant}}</td>
				<td>{{number_format($row->total, 2)}}</td>
			</tr>
			@php
				$cant += $row->cant;
				$total += $row->total;
			@endphp
			@endforeach
			<tr>
				<td colspan="3">TOTAL</td>
				<td>{{$cant}}</td>
				<td>{{number_format($total, 2)}}</td>
			</tr>
		</table>
	</pre>
</body>
</html>