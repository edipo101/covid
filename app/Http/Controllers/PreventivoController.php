<?php

namespace App\Http\Controllers;

use App\Preven_men;
use App\Preventivo;
use App\Reporte;
use Illuminate\Http\Request;

class PreventivoController extends Controller
{
    // Listar preventivos
    public function show_all(Request $request){
    	$preven = Preventivo::Preven($request->get('search'))->paginate(15);
    	return view('preventivos', compact('preven'));
    }

    public function compras_men(){
    	$preven = Preven_men::get();
    	return view('prueba', compact('preven'));
    }

    public function view(Request $request){
        if ($request->ajax()){
            $id = $request->input('id');
            $preventivo = Preventivo::where('id_preventivo', $id)->limit(1)->get();
            echo json_encode($preventivo);
        }
    }

    public function search($id){
        // {{ $request }};
        echo $id;
    }
}
