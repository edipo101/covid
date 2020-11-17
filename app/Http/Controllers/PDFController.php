<?php

namespace App\Http\Controllers;

use App\Objeto;
use App\Preventivo;
use App\Secretaria;
use App\Tipo;
use App\UbicacionMen;
use App\Unidad;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function pdf(Request $request){
    	$reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->orderBy('preventivo')
        ->get();
        $fuente = $request->get('f');
        $organismo = $request->get('o');
        $id_partida = $request->get('p');
        $partida = Objeto::where('id_objeto', $id_partida)->pluck('descripcion')->first();

        // return view('pdfs.pdf_all', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida'));
    	$pdf = \PDF::loadView('pdfs.pdf_all', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida'))
        ->setPaper('letter', 'landscape');
    	return $pdf->stream('preventivos.pdf');
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
        ->orderBy('preventivo')
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
        return $pdf->stream('comp_menores.pdf');
    }

    public function pdf_secretarias(Request $request){
        $reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->leftJoin('secretaria', 'preventivo.id_secretaria', '=', 'secretaria.id_secretaria')
        ->leftJoin('unidad', 'preventivo.id_unidad', '=', 'unidad.id_unidad')
        ->Secretaria($request->get('se'))
        ->Unidad($request->get('un'))
        ->Tipo($request->get('t'))
        ->Ubicacion($request->get('t'), $request->get('ub'))
        ->Preven($request->get('search'))
        ->orderBy('preventivo')
        ->get();
        $secretaria = Secretaria::where('id_secretaria', $request->get('se'))->pluck('secretaria')->first();
        $unidad = Unidad::where('id_unidad', $request->get('un'))->pluck('unidad')->first();
        $tipo = Tipo::where('id_tipo', $request->get('t'))->pluck('tipo')->first();
        $id_ubicacion = $request->get('ub');
        if ($request->get('t') == 1)
            $ubicacion = UbicacionMen::where('id_ubicacion', $id_ubicacion)->pluck('ubicacion')->first();
        else
            $ubicacion = UbicacionDir::where('id_ubicacion', $id_ubicacion)->pluck('ubicacion')->first();

        // return view('pdfs.pdf_secretarias', compact('reg', 'secretaria', 'unidad', 'tipo', 'ubicacion'));
        $pdf = \PDF::loadView('pdfs.pdf_secretarias', compact('reg', 'secretaria', 'unidad', 'tipo', 'ubicacion'))
        ->setPaper('letter', 'landscape');
        return $pdf->stream('comp_bysecretarias.pdf');
    }
}
