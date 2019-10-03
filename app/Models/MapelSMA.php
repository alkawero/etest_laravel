<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapelSMA extends Model
{
    protected $connection   = 'nilai_sma_2017';
    protected $table        = 'mst_pelajaran';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;
}
