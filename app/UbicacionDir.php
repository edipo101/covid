<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbicacionDir extends Model
{
    protected $table = 'ubicacion_dir';
    protected $primaryKey = 'id_ubicacion';
    public $timestamps = false;
}
