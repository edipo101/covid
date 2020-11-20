<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organismo;

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
}
