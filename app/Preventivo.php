<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preventivo extends Model
{
    protected $table = 'preventivo';
    
    public function scopePreven($query, $preven){
    	// dd('scope: '.$id);
    	if ($preven != "")
    		$query->where('preventivo', $preven);
    }
}
