<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmMapel extends Model
{
    protected $connection   = 'teacher_adm';
    protected $table        = 'ms_mapel';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;


    public function kis()
    {
        return  $this->hasMany('App\Models\AdmKi', 'mapel_id');
    }


}
