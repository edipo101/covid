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
}
