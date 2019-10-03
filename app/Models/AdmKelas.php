<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmKelas extends Model
{
    protected $connection   = 'teacher_adm';
    protected $table        = 'ms_kelas';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;
}
