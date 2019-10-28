<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSMA extends Model
{
    protected $connection   = 'nilai_sma_2017';
    protected $table        = 'mst_sma_siswa';
    protected $primaryKey   = 'nis';
    protected $keyType      = 'int';
    public    $incrementing =  false;
    public $jenjang = 'SMA';

    public function kelas($tahunAjaran)
    {
        return $this->belongsToMany('App\Models\KelasSMA', 'mst_sma_siswa', 'nis', 'kelas')->where('tahunajaran',$tahunAjaran);
    }
}
