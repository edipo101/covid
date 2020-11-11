<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preventivo extends Model
{
    protected $table = 'preventivo';
    protected $primaryKey = 'id_preventivo';
    public $timestamps = false;
    
    public function scopePreven($query, $preven){
    	if ($preven != "")
    		$query->where('preventivo', $preven);
    }

    public function scopeFuente($query, $fuente){
    	if ($fuente != "")
    		$query->where('fuente', $fuente);		
    }

    public function scopeOrganismo($query, $org){
    	if ($org != "")
    		$query->where('organismo', $org);		
    }

    public function scopePartida($query, $partida){
    	if ($partida != "")
    		$query->where('id_objeto', $partida);		
    }

    public function scopeSecretaria($query, $secre){
        if ($secre != "")
            $query->where('preventivo.id_secretaria', $secre);       
    }

    public function scopeUnidad($query, $unidad){
        if ($unidad != "")
            $query->where('preventivo.id_unidad', $unidad);       
    }
}
