<?php

namespace App\Http\Controllers;

use App\Objeto;
use App\Preventivo;
use App\Reporte_montos;
use App\Secretaria;
use App\Tipo;
use App\UbicacionMen;
use App\UbicacionDir;
use App\Unidad;
use App\Estado;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function pdf(Request $request){
    	$reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->leftJoin('estado', 'preventivo.id_estado', '=', 'estado.id_estado')
        ->Tipo($request->get('t'))
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->Desembolso($request->get('desem'))
        ->orderBy('fuente')
        ->orderBy('organismo')
        ->get();
        $fuente = $request->get('f');
        $organismo = $request->get('o');
        $id_partida = $request->get('p');
        $partida = Objeto::where('id_objeto', $id_partida)->pluck('descripcion')->first();
        $tipo = Tipo::where('id_tipo', $request->get('t'))->pluck('tipo')->first();
        $desembolso = $request->get('desem');

        return view('pdfs.pdf_all', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida', 'tipo', 'desembolso'));
    	$pdf = \PDF::loadView('pdfs.pdf_all', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida', 'tipo'))
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

    public function pdf_mayores(Request $request){
        $reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->leftJoin('ubicacion_dir', 'preventivo.id_ubidir', '=', 'ubicacion_dir.id_ubicacion')
        ->leftJoin('estado', 'preventivo.id_estado', '=', 'estado.id_estado')
        ->where('preventivo.id_tipo', 2)
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->orderBy('fuente', 'asc')
        ->orderBy('organismo', 'asc')
        ->orderBy('id_objeto', 'asc')
        ->get();
        $fuente = $request->get('f');
        $organismo = $request->get('o');
        $id_partida = $request->get('p');
        $partida = Objeto::where('id_objeto', $id_partida)->pluck('descripcion')->first();

        // return view('pdfs.pdf_mayores', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida'));
        $pdf = \PDF::loadView('pdfs.pdf_mayores', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida'))
        ->setPaper('letter', 'landscape');
        return $pdf->stream('comp_mayores.pdf');
    }

    public function pdf_secretarias(Request $request){
        $reg = Preventivo::selectRaw('*, 
            if(id_ubimen is not null, 
                round(id_ubimen/7*100), 
                if(id_ubidir is not null, 
                round(id_ubidir/9*100), null)) as porcent,
            if(id_ubimen is not null, 
                ubicacion_men.ubicacion, 
                if(id_ubidir is not null, 
                ubicacion_dir.ubicacion, null)) as ubicacion')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->leftJoin('secretaria', 'preventivo.id_secretaria', '=', 'secretaria.id_secretaria')
        ->leftJoin('unidad', 'preventivo.id_unidad', '=', 'unidad.id_unidad')
        ->leftJoin('ubicacion_men', 'preventivo.id_ubimen', '=', 'ubicacion_men.id_ubicacion')
        ->leftJoin('ubicacion_dir', 'preventivo.id_ubidir', '=', 'ubicacion_dir.id_ubicacion')
        ->leftJoin('estado', 'preventivo.id_estado', '=', 'estado.id_estado')
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
        // return $reg;
        // return view('pdfs.pdf_secretarias', compact('reg', 'secretaria', 'unidad', 'tipo', 'ubicacion'));
        $pdf = \PDF::loadView('pdfs.pdf_secretarias', compact('reg', 'secretaria', 'unidad', 'tipo', 'ubicacion'))
        ->setPaper('letter', 'landscape');
        return $pdf->stream('comp_bysecretarias.pdf');
    }

    public function pdf_presupuesto(Request $request){
        $reg = Reporte_montos::
            selectRaw('*, monto_aprob - monto_preven as saldo_aprob, monto_preven - monto_pagado as saldo_preven, monto_aprob - monto_pagado as saldo_deven')
            ->Fuente($request->get('f'))
            ->Organismo($request->get('o'))
            ->orderBy('fuente', 'asc')
            ->orderBy('organismo', 'asc')
            ->orderBy('partida', 'asc')
            ->get();
        
        $fuente = $request->get('f');
        $organismo = $request->get('o');

        // return view('pdfs.pdf_presupuesto', compact('reg', 'fuente', 'organismo'));
        $pdf = \PDF::loadView('pdfs.pdf_presupuesto', compact('reg', 'fuente', 'organismo'))
        ->setPaper('letter', 'landscape');
        return $pdf->stream('presupuesto.pdf');
    }

    public function pdf_liberados(Request $request){
        $reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent, (importe - pagado) as liberado,
            if(id_ubimen is not null, 
                ubicacion_men.ubicacion, 
                if(id_ubidir is not null, 
                ubicacion_dir.ubicacion, null)) as ubicacion')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->leftJoin('secretaria', 'preventivo.id_secretaria', '=', 'secretaria.id_secretaria')
        ->leftJoin('unidad', 'preventivo.id_unidad', '=', 'unidad.id_unidad') 
        ->leftJoin('ubicacion_men', 'preventivo.id_ubimen', '=', 'ubicacion_men.id_ubicacion')
        ->leftJoin('ubicacion_dir', 'preventivo.id_ubidir', '=', 'ubicacion_dir.id_ubicacion')
        ->leftJoin('estado', 'preventivo.id_estado', '=', 'estado.id_estado')
        ->MayorAConta($request->get('t'))       
        ->Tipo($request->get('t'))
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->whereRaw('(importe - pagado) > 0')
        ->orderBy('preventivo')
        ->get();
        $fuente = $request->get('f');
        $organismo = $request->get('o');
        $id_partida = $request->get('p');
        $partida = Objeto::where('id_objeto', $id_partida)->pluck('descripcion')->first();
        $tipo = Tipo::where('id_tipo', $request->get('t'))->pluck('tipo')->first();
        // return $reg;
        // return view('pdfs.pdf_liberados', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida', 'tipo'));
        $pdf = \PDF::loadView('pdfs.pdf_liberados', compact('reg', 'fuente', 'organismo', 'id_partida', 'partida', 'tipo'))
        ->setPaper('letter', 'landscape');
        return $pdf->stream('por_liberar.pdf');
    }
}
