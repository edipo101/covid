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

    // Listar todos preventivos
    public function show_all(Request $request){
    	$preven = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->Preven($request->get('search'))->paginate(25);
    	return view('preventivos', compact('preven'));
    }

    // Listar compras menores
    public function show_menores(Request $request){
        $preven = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->Preven($request->get('search'))
        ->where('tipo', 'CM')->paginate(25);
        return view('preventivos', compact('preven'));
    }

    // Listar compras mayores o directas
    public function show_mayores(Request $request){
        $preven = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->Preven($request->get('search'))
        ->where('tipo', 'CD')->paginate(25);
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
            $preventivo = Preventivo::selectRaw('*, ubicacion_men.ubicacion as ubimen, ubicacion_dir.ubicacion as ubidir,
                if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
            ->leftJoin('ubicacion_men', 'id_ubimen', '=', 'ubicacion_men.id_ubicacion')
            ->leftJoin('ubicacion_dir', 'id_ubidir', '=', 'ubicacion_dir.id_ubicacion')
            ->where('id_preventivo', $id)->first();
            $preventivo->importe = number_format($preventivo->importe, 2);
            $preventivo->fecha_elab = date('d/m/Y', strtotime($preventivo->fecha_elab));
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
        $tipos = array(
            'CM' => 'Compra menor'
        );
        
        return view('preventivos.create', compact('row', 'estados', 'ubicaciones', 'tipos'));
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
