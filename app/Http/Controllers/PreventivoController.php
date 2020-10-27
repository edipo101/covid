<?php

namespace App\Http\Controllers;

use App\Preven_men;
use App\Preventivo;
use App\Reporte;
use Illuminate\Http\Request;

class PreventivoController extends Controller
{
    // private $ubicaciones = ["UNID_SOLIC", "COMPRAS", "CONTABILIDAD", "DIR_FINANCIERA", "JURIDICA", "RPC",
    //         "TESORERIA", "SMAF", "ALMACEN"];
    private $ubicaciones = ["1. UNID_SOLIC", "2. COMPRAS", "3. CONTABILIDAD", "4. DIR_FINANCIERA", 
        "5. ALMACEN", "6. TESORERIA", "7. SMAF"];

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

    public function create(){
        $row = new Preventivo;
        $estados = Preventivo::groupBy('estado')->havingRaw('not isnull(estado)')->pluck('estado');
        $ubicaciones = $this->ubicaciones;
        
        return view('preventivos.create', compact('row', 'estados', 'ubicaciones'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nro_preven' => 'required',
            'detalle' => 'required'
        ]);
        $preven = new Preventivo;
        $preven->preventivo = request('nro_preven');
        $preven->importe = request('importe');
        // $preven->save();

        return $preven;
        return redirect()->route('preventivos.all');
    }

    public function edit($id){
        $row = Preventivo::where('id_preventivo', $id)->first();
        $estados = Preventivo::groupBy('estado')->havingRaw('not isnull(estado)')->pluck('estado');
        $ubicaciones = $this->ubicaciones;
        
        return view('preventivos.edit', compact('row', 'estados', 'ubicaciones'));
    }

    public function update(Request $request, $id){
        // return $request;
        $preven = Preventivo::findOrFail($id);
        $validatedData = $request->validate([
            'nro_preven' => 'required',
            'detalle' => 'required'
        ]);
        $preven->preventivo = request('nro_preven');
        $preven->glosa = request('detalle');
        $preven->importe = request('importe');
        $var = request('fecha_elab');
        $date = str_replace('/', '-', $var);
        $fecha = date("Y-m-d", strtotime($date));
        return $fecha;
        $preven->save();

        return redirect()->route('preventivos.all');
    }
}
