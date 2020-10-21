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
    	$report = Reporte::where([['fuente', 20], ['organismo', 230]])->get();
    	return view('reporte_fuenteorg', compact('report'));
    }
}
