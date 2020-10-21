	<pre>
		<table>
			<tr>
				<th>No</th>
				<th>Preventivo</th>
				<th>Importe</th>
				<th>Detalle</th>
				<th>fecha_elab</th>
				<th>fecha_verif</th>
			</tr>
			@foreach($preven as $row)
			<tr>
				<td>{{++$loop->index}}</td>
				<td>{{$row->preventivo}}</td>
				<td>{{$row->importe}}</td>
				{{-- <td>{{substr($row->glosa, 0, 100)}}</td> --}}
				<td>{{$row->detalle}}</td>
				<td>{{$row->fecha_elab}}</td>
				<td>{{$row->fecha_verif}}</td>
			</tr>
			@endforeach
		</table>
	</pre>