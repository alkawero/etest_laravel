<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmTrxKdIndi extends Model
{
    protected $connection   = 'teacher_adm';
    protected $table        = 'trx_kd_indi';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;

    public function ranah()
    {
        return $this->hasOne('App\Models\AdmRanah','ranah_kode','indi_ranah');
    }

    public function kd()
    {
        return $this->belongsTo('App\Models\AdmKd', 'kd_id');
    }
}


