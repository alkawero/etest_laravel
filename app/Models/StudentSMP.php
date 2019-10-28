<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSMP extends Model
{
    protected $connection   = 'nilai_smp';
    protected $table        = 'ms_siswa';
    protected $primaryKey   = 'nis';
    protected $keyType      = 'int';
    public    $incrementing =  false;
    public $jenjang = 'SMP';

    public function kelas($tahunAjaran)
    {
        return $this->belongsToMany('App\Models\KelasSMP', 'set_siswa_kelas', 'nis', 'kelas_id')->where('tahunajaran',$tahunAjaran);
    }
}
