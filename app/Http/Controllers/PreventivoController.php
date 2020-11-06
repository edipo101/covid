<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Preven_men;
use App\Preventivo;
use App\Reporte;
use App\Secretaria;
use App\Tipo;
use App\UbicacionDir;
use App\UbicacionMen;
use App\Unidad;
use Illuminate\Http\Request;

class PreventivoController extends Controller
{
    // Listar todos preventivos
    public function show_all(Request $request){
    	$reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->paginate(25);            
    	return view('preventivos', compact('reg'));
    }

    // Listar compras menores
    public function show_menores(Request $request){
        $reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->where('preventivo.id_tipo', 1)
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->paginate(25);
        return view('menores', compact('reg'));
    }

    // Listar compras mayores o directas
    public function show_mayores(Request $request){
        $reg = Preventivo::selectRaw('*, if(id_ubimen is not null, round(id_ubimen/7*100), if(id_ubidir is not null, round(id_ubidir/9*100), null)) as porcent')
        ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
        ->where('preventivo.id_tipo', 2)
        ->Fuente($request->get('f'))
        ->Organismo($request->get('o'))
        ->Partida($request->get('p'))
        ->Preven($request->get('search'))
        ->paginate(25);
        return view('directas', compact('reg'));
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
            ->leftJoin('secretaria', 'preventivo.id_secretaria', '=', 'secretaria.id_secretaria')
            ->leftJoin('unidad', 'preventivo.id_unidad', '=', 'unidad.id_unidad')
            ->leftJoin('tipo', 'preventivo.id_tipo', '=', 'tipo.id_tipo')
            ->leftJoin('estado', 'preventivo.id_estado', '=', 'estado.id_estado')
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

        $tabla3 = Reporte::whereRaw('fuente = 41 and organismo = 111')
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
        $preven = Preventivo::where('id_preventivo', $id)->first();
        
        $tipos = Tipo::pluck('tipo', 'id_tipo');
        $estados = Estado::pluck('estado', 'id_estado');
        $ubicaciones_men = UbicacionMen::pluck('ubicacion', 'id_ubicacion');
        $ubicaciones_dir = UbicacionDir::pluck('ubicacion', 'id_ubicacion');
        $secretarias = Secretaria::all();
        $unidades = (!is_null($preven->id_secretaria)) ? Unidad::where('id_secretaria', $preven->id_secretaria)->get() : null;
        return view('preventivos.edit', compact('preven', 'tipos', 'estados', 'ubicaciones_men', 
            'ubicaciones_dir', 'secretarias', 'unidades'));
    }

    public function update(Request $request, $id){
        // return $request;
        $preven = Preventivo::findOrFail($id);
        $validatedData = $request->validate([
            // 'nro_preven' => 'required',
            'id_objeto' => 'required',
            'fuente' => 'required',
            'organismo' => 'required',
            'id_tipo' => 'required',
        ]);
        // $preven->preventivo = request('nro_preven');
        $date = str_replace('/', '-', request('fecha_elab'));
        $fecha = date("Y-m-d", strtotime($date));
        $preven->fecha_elab = $fecha;
        $preven->id_secretaria = request('id_secretaria');
        $preven->id_unidad = request('id_unidad');
        $preven->glosa = request('glosa');
        // $preven->importe = request('importe');
        $preven->id_objeto = request('id_objeto');
        $tipo = request('id_tipo');
        $ubimen = null;
        $ubidir = null;
        $preven->id_ubimen = ($tipo == 1) ? request('ubicacion') : null; 
        $preven->id_ubidir = ($tipo == 2) ? request('ubicacion') : null; 
        $preven->id_tipo = $tipo;
        $preven->id_estado = request('id_estado');
        $preven->observaciones = request('observaciones');
        $preven->desembolso = request('desembolso');
        
        // return $preven;
        $preven->save();

        return redirect()->route('preventivos.all');
    }
}
