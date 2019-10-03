<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmKi extends Model
{
    protected $connection   = 'teacher_adm';
    protected $table        = 'trx_ki';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;


    public function kds()
    {
        return  $this->hasMany('App\Models\AdmKd', 'ki_id');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Models\AdmKelas', 'kelas_id');
    }


}
