<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmKd extends Model
{
    protected $connection   = 'teacher_adm';
    protected $table        = 'trx_kd';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;

    public function ki()
    {
        return $this->belongsTo('App\Models\AdmKi', 'ki_id','id');
    }


    public function ranahs()
    {
        return $this->hasMany('App\Models\AdmTrxKdIndi','kd_id');
    }
    

}
