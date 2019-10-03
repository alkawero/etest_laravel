<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmRanah extends Model
{
    protected $connection   = 'teacher_adm';
    protected $table        = 'ms_ranah';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;
}
