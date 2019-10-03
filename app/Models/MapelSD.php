<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapelSD extends Model
{
    protected $connection   = 'nilai_sdk13';
    protected $table        = 'ms_mapel';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;
}
