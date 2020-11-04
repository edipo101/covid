<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipo';
    protected $primaryKey = 'id_tipo';
    public $timestamps = false;
}
