<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
	{{-- <link rel="stylesheet" href="{{asset('scripts/css/app.css')}}"> --}}
	<style type="text/css">

		body {
		  /*font-family: "Times New Roman", serif;*/
		  margin: 5mm 8mm 2mm 8mm;
		}
		hr {
		  page-break-after: always;
		  /*border: 0;*/
		  margin: 0;
		  padding: 0;
		}
		* {
	        font-family: Verdana, Arial, sans-serif;
	    }
	    table{
	        /*font-size: x-small;*/
	    }
	    tfoot tr td{
	        font-weight: bold;
	        /*font-size: x-small;*/
	    }
	    .gray {
	        background-color: lightgray
	    }
	    header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 30px;
        }
	</style>
</head>
<body style="font-size: 50%">


	<main>
		<h1>Lista de preventivos</h1>
	<table>
	<tbody>
	  <tr style="background-color: lightgray;">
	   <th>No.</th>
	   <th>Nro Prev</th>
	   <th>Importe (Bs)</th>
	   <th>Detalle (Glosa)</th>
	   <th>Fecha elab</th>
	   <th>Fte-Org</th>
	   <th>Partida</th>
	   <th>Tipo</th>
	   <th>Progreso</th>
	  </tr>
	  @foreach($reg as $row)
	  <tr data-id="{{$row->id_preventivo}}">
	   <td>{{$loop->iteration}}</td>
	   <td>{{$row->preventivo}}</td>
	   <td>{{number_format($row->importe, 2)}}</td>
	   <td width="50%">{{$row->glosa}}</td>
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
	</main>
</body>
</html>