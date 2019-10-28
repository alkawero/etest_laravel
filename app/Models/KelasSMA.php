<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasSMA extends Model
{
    protected $connection   = 'nilai_sma_2017';
    protected $table        = 'mst_sma_kelas';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;
    public $jenjang = 'SMA';


    public function students($tahunAjaran)
    {
        return $this->belongsToMany('App\Models\StudentSMA', 'mst_sma_siswa', 'kelas','nis')->where('tahunajaran',$tahunAjaran);
    }
}
