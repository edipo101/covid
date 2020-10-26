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

    // Vista detalle preventivo
    public function view(Request $request){
        if ($request->ajax()){
            $id = $request->input('id');
            $preventivo = Preventivo::where('id_preventivo', $id)->first();
            echo json_encode($preventivo);
        }
    }

    public function rep_ejec_presup(){
        $tabla1 = Reporte::whereRaw('fuente = 20 and organismo = 210')
        ->orderBy('id_objeto', 'asc')
        ->get();

        $tabla2 = Reporte::whereRaw('fuente = 20 and organismo = 230')
        ->orderBy('id_objeto', 'asc')
        ->get();
        return view('reporte_fuenteorg', compact('tabla1', 'tabla2'));
    }

    public function edit($id){
        $row = Preventivo::where('id_preventivo', $id)->first();
        return view('form', compact('row'));
    }

    public function update(Request $request, $id){
        $preven = Preventivo::findOrFail($id);
        $validatedData = $request->validate([
            'nro_preven' => 'required',
            'detalle' => 'required'
        ]);
        $preven->preventivo = request('nro_preven');
        $preven->glosa = request('detalle');
        $preven->importe = request('importe');
        // return $preven;
        $preven->save();

        return redirect()->route('preventivos.all');
    }
}
