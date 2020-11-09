<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Preventivo;

class PDFController extends Controller
{
    public function pdf(Request $request){
    	$reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->paginate(25);

    	// $pdf = app('dompdf.wrapper');
    	$pdf = \PDF::loadView('pdfs.prueba', compact('reg'));
    	// $pdf->loadHTML('<h1>Styde.net</h1>');
    	return $pdf->stream('archivo.pdf');
    }
}
