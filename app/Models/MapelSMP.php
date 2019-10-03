<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapelSMP extends Model
{
    protected $connection   = 'nilai_smp';
    protected $table        = 'ms_mapel';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;
}
