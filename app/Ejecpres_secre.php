<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejecpres_secre extends Model
{
    protected $table = 'ejec_presup_secre';

    public function scopeSecretaria($query, $id_secre){
    	if ($id_secre != "")
    		$query->where('id_secretaria', $id_secre);		
    }
}
