<?php

namespace App\Http\Controllers;

use App\Preven_men;
use App\Preventivo;
use App\Reporte;
use Illuminate\Http\Request;

class Prueba extends Controller
{
    public function show(){
    	$preven = Preventivo::get();
    	return view('prueba', compact('preven'));
    }

    public function compras_men(){
    	$preven = Preven_men::get();
    	return view('prueba', compact('preven'));
    }

    public function reporte(){
	   // $report = Preventivo::selectRaw('fuente, organismo, id_objeto, count(*) as cant, sum(importe) as total')
       // ->groupByRaw('fuente, organismo, id_objeto')
       // ->get();
        return view('layout');
        return view('reporte_fuenteorg', compact('report'));
    }
}
