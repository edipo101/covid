<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Preventivo;
use App\Objeto;
use App\UbicacionMen;

class PDFController extends Controller
{
    public function pdf(Request $request){
    	$reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->get();
        $fuente = $request->get('f');
        $organismo = $request->get('o');
        $id_partida = $request->get('p');
        $partida = Objeto::where('id_objeto', $id_partida)->pluck('descripcion')->first();

        // return view('pdfs.prueba', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida'));
    	$pdf = \PDF::loadView('pdfs.prueba', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida'))
        ->setPaper('letter', 'landscape');
    	return $pdf->download('archivo.pdf');
    }

    public function pdf_menores(Request $request){
        $reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->leftJoin('ubicacion_men', 'id_ubimen', '=', 'ubicacion_men.id_ubicacion')
        ->where('preventivo.id_tipo', 1)
        ->UbicacionMen($request->get('ub'))
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->get();
        $fuente = $request->get('f');
        $organismo = $request->get('o');
        $id_partida = $request->get('p');
        $id_ubicacion = $request->get('ub');
        $partida = Objeto::where('id_objeto', $id_partida)->pluck('descripcion')->first();
        $ubicacion = UbicacionMen::where('id_ubicacion', $id_ubicacion)->pluck('ubicacion')->first();

        // return view('pdfs.pdf_menores', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida', 'ubicacion'));
        $pdf = \PDF::loadView('pdfs.pdf_menores', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida', 'ubicacion'))
        ->setPaper('letter', 'landscape');
        return $pdf->download('comp_menores.pdf');
    }
}
