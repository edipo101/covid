<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    protected $table = 'organismo';
    protected $primaryKey = 'id_org';
    public $timestamps = false;
}
