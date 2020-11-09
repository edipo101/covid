<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	{{-- <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}"> --}}
	<!-- Font Awesome -->
	{{-- <link rel="stylesheet" href="{{config('app.url')}}/bower_components/font-awesome/css/font-awesome.min.css"> --}}
	<!-- Ionicons -->
	{{-- <link rel="stylesheet" href="{{config('app.url')}}/bower_components/Ionicons/css/ionicons.min.css"> --}}
	<!-- Theme style -->
	{{-- <link rel="stylesheet" href="{{config('app.url')}}/dist/css/AdminLTE.min.css"> --}}
	{{-- <link rel="stylesheet" href="{{config('app.url')}}/dist/css/skins/skin-blue.min.css"> --}}

	{{-- Own style --}}
	<link rel="stylesheet" href="{{config('app.url')}}/scripts/css/app.css">
</head>
<body>
	Esto es un prueba para ver si funciona. <br>
	<div class="row">
	    <div class="col-xs-12">
			<div class="box">
				<div class="box-body table-responsive no-padding">
			          <table class="table table-hover table-striped table-bordered">
			            <tbody>
			              <tr>
			               <th>Nro Prev</th>
			               <th>Importe (Bs)</th>
			               {{-- <th style="width: 40%;">Detalle (Resumen)</th> --}}
			               <th>Fecha elab</th>
			               <th>Fte-Org</th>
			               <th>Partida</th>
			               <th>Tipo</th>
			               <th>Progreso</th>
			               <th>(%)</th>
			               {{-- <th>Operaciones</th> --}}
			              </tr>
			              @foreach($reg as $row)
			              <tr data-id="{{$row->id_preventivo}}">
			               <td>{{$row->preventivo}}</td>
			               <td>{{number_format($row->importe, 2)}}</td>
			               {{-- <td>{{$row->glosa}}</td> --}}
			               <td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
			               <td>{{$row->fuente}}-{{$row->organismo}}</td>
			               <td>{{$row->id_objeto}}</td>
			               @php $label = (isset($row->label)) ? $row->label : 'default'; @endphp
			               <td><span class="label label-{{$label}}">{{$row->tipo}}</span></td>
			               <td>
			                <div class="progress progress-xs">
			                  @php
			                  $label = 'green';
			                  if ($row->porcent <= 25) $label = 'red';
			                  if ($row->porcent > 26 && $row->porcent <= 50) $label = 'yellow';
			                  if ($row->porcent > 51 && $row->porcent <= 75) $label = 'aqua';
			                  @endphp
			                  <div class="progress-bar progress-bar-{{$label}}" style="width: {{$row->porcent}}%"></div>
			                </div>
			                <td>
			                  @if (!is_null($row->porcent))
			                  <span class="badge bg-{{$label}}">{{$row->porcent}}%</span>
			                  @endif
			                </td>
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