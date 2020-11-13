<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    protected $table = 'objeto';
    protected $primaryKey = 'id_objeto';
    public $timestamps = false;
}
