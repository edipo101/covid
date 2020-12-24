<?php

namespace App\Http\Controllers;

use App\Ejecpres_secre;
use App\Organismo;
use App\Preventivo;
use App\Reporte_montos;
use App\ViewResumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function show_resumen() {
        $org = ViewResumen::get();
        // return $org;
        return view('resumen', compact('org'));
    }

    public function show_desembolsos() {
    	$tot_1 = Organismo::
    	selectRaw('sum(desem_1) as tot')->pluck('tot')->first();

    	$org = Organismo::
    	selectRaw('fuente, organismo, desem_1, 
    		round((desem_1/'.$tot_1.'*100), 2) porc_1,
    		desem_23,
    		round((desem_23/23133349*100), 2) porc_23,
    		(desem_1 + desem_23) as total')->get();
    	return view('rep_desembolsos', compact('org'));
    	return $org;
    }

    public function show_presupuesto(Request $request){
        $reg = Reporte_montos::
            selectRaw('*, 
                (monto_aprob - monto_preven) as saldo_aprob, 
                (monto_preven - monto_pagado) as saldo_preven, 
                (monto_aprob - monto_pagado) as saldo_deven
                ')
            ->Fuente($request->get('f'))
            ->Organismo($request->get('o'))
            ->orderBy('fuente', 'asc')
            ->orderBy('organismo', 'asc')
            ->orderBy('partida', 'asc')
            ->get();
        return view('partidas.presupuesto', compact('reg'));
    }

    public function show_presupuesto_desem(Request $request){
        $reg = Preventivo::
            selectRaw('
            fuente, organismo, preventivo.id_objeto, objeto.descripcion, count(*) cant,
            (select pa.monto_aprob from presup_aprob pa where pa.organismo = preventivo.organismo and pa.id_objeto = preventivo.id_objeto) monto_aprob,
            sum(importe) monto_preven, 
            sum(pagado) monto_pagado, 
            sum(cancelado) monto_cancelado, 
            ((select pa.monto_aprob from presup_aprob pa where pa.organismo = preventivo.organismo and pa.id_objeto = preventivo.id_objeto) - sum(importe)) saldo_aprob,
            sum(importe)-sum(pagado) saldo_preven, 
            ((select pa.monto_aprob from presup_aprob pa where pa.organismo = preventivo.organismo and pa.id_objeto = preventivo.id_objeto) - sum(pagado)) saldo_deven
                ')
            ->leftJoin('objeto', 'preventivo.id_objeto', '=', 'objeto.id_objeto')
            ->Fuente($request->get('f'))
            ->Organismo($request->get('o'))
            ->Desembolso($request->get('desem'))
            ->orderBy('fuente', 'asc')
            ->orderBy('organismo', 'asc')
            ->orderBy('id_objeto', 'asc')
            ->groupBy('fuente', 'organismo', 'id_objeto')
            ->get();
        // return $reg;
        return view('partidas.presupuesto', compact('reg'));
    }

    public function presup_bysecre(Request $request){
        $reg = Ejecpres_secre::
            selectRaw('*')
            ->Secretaria($request->get('secre'))
            // ->orderBy('fuente', 'asc')
            // ->orderBy('organismo', 'asc')
            // ->orderBy('partida', 'asc')
            ->get();

        return view('partidas.presup_bysecre', compact('reg'));
    }
}
