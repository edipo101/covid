<?php

namespace App\Http\Controllers;

use App\Preven_men;
use App\Preventivo;
use App\Reporte;
use Illuminate\Http\Request;

class PreventivoController extends Controller
{
    public function show_all(Request $request){
        // dd($request->get('search'));
    	$preven = Preventivo::Preven($request->get('search'))->paginate(15);
        // $preven = Preventivo::where('id_preventivo', $request->get('search'))->paginate(15);

        // return $preven;
    	return view('preventivos', compact('preven'));
    }

    public function compras_men(){
    	$preven = Preven_men::get();
    	return view('prueba', compact('preven'));
    }

    public function details($id_preventivo){
        $preven = Preventivo::where('id_preventivo', $id_preventivo)->limit(1)->paginate(15);
        return view('preventivos', compact('preven'));
    }

    public function search($id){
        // {{ $request }};
        echo $id;
    }
}
