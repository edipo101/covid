<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte_montos extends Model
{
    protected $table = 'view_objeto_montos';

    public function scopeFuente($query, $fuente){
    	if ($fuente != "")
    		$query->where('fuente', $fuente);		
    }

    public function scopeOrganismo($query, $org){
    	if ($org != "")
    		$query->where('organismo', $org);		
    }
}
