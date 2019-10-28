<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasSD extends Model
{
    protected $connection   = 'nilai_sdk13';
    protected $table        = 'ms_kelas';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;
    public $jenjang = 'SD';


    public function students($tahunAjaran)
    {
        return $this->hasMany('App\Models\StudentSD', 'kelas_id')->where('tahunajaran',$tahunAjaran);
    }

}
