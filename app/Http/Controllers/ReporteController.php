<?php

namespace App\Http\Controllers;

use App\Organismo;
use App\Reporte_montos;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
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
            selectRaw('*, monto_aprob - monto_preven as saldo_aprob, monto_preven - monto_pagado as saldo_preven, monto_aprob - monto_pagado as saldo_deven')
            ->Fuente($request->get('f'))
            ->Organismo($request->get('o'))
            ->orderBy('fuente', 'asc')
            ->orderBy('organismo', 'asc')
            ->orderBy('partida', 'asc')
            ->get();

        return view('partidas.presupuesto', compact('reg'));
    }
}
