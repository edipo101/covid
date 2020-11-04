<?php

namespace App\Http\Controllers;

use App\UbicacionDir;
use App\UbicacionMen;
use Illuminate\Http\Request;

class ComboDatos extends Controller
{
    public function getUbicacionesMen(){
        try {    
            $ubicacion_mens = UbicacionMen::all();
            $response = ['data' => $ubicacion_mens];
        } catch (\Exception $exception) {
            return response()->json([ 'message' => 'Hubo un error al recuperar los registros' ], 500);
        }
        return response()->json($response);
    }

    public function getUbicacionesDir(){
        try {    
            $ubicacion_dirs = UbicacionDir::all();
            $response = ['data' => $ubicacion_dirs];
        } catch (\Exception $exception) {
            return response()->json([ 'message' => 'Hubo un error al recuperar los registros' ], 500);
        }
        return response()->json($response);
    }
}
