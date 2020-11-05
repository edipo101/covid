<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    protected $table = 'secretaria';
    protected $primaryKey = 'id_secretaria';
    public $timestamps = false;
}
