<?php

namespace App\Http\Controllers;

use App\Preventivo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }

    public function show(){
    	$preven = Preventivo::selectRaw('fuente, organismo, count(*) as cant, 
            sum(importe) as imp_preven, sum(pagado) as imp_deven, (sum(importe)-sum(pagado)) as liberado')
    	->groupBy('fuente', 'organismo')
    	->get();

		$sec_unid = Preventivo::selectRaw('sigla, secretaria, count(*) as cant, sum(importe) as total')
		->leftJoin('secretaria', 'preventivo.id_secretaria', '=', 'secretaria.id_secretaria')
    	->groupBy('preventivo.id_secretaria')
    	->get();
    	// return $sec_unid;
    	return view('dashboard', compact('preven', 'sec_unid'));
    }
}
