<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('scripts/css/app.css')}}">
</head>
<body style="font-size: 50%">
	<div class="row">
	    <div class="col-xs-12">
			<div class="box">
				<div class="box-body table-responsive no-padding">
			          <table class="table table-hover table-striped table-bordered">
			            <tbody>
			              <tr>
			               <th>No.</th>
			               <th>Nro Prev</th>
			               <th>Importe (Bs)</th>
			               <th>Detalle (Glosa)</th>
			               <th>Fecha elab</th>
			               <th>Fte-Org</th>
			               <th>Partida</th>
			               <th>Tipo</th>
			               <th>(%)</th>
			              </tr>
			              @foreach($reg as $row)
			              <tr data-id="{{$row->id_preventivo}}">
			               <td>{{$loop->iteration}}</td>
			               <td>{{$row->preventivo}}</td>
			               <td>{{number_format($row->importe, 2)}}</td>
			               <td>{{$row->glosa}}</td>
			               <td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
			               <td>{{$row->fuente}}-{{$row->organismo}}</td>
			               <td>{{$row->id_objeto}}</td>
			               <td>{{$row->tipo}}</td>
			               <td>
			                  @if (!is_null($row->porcent))
			                  {{$row->porcent}}%
			                  @endif
			              	</td>
			              </tr>
			              @endforeach
			            </tbody>
			          </table>
			    </div>
		    </div>
		</div>
	</div>
</body>
</html>