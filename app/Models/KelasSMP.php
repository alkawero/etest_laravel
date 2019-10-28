<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasSMP extends Model
{
    protected $connection   = 'nilai_smp';
    protected $table        = 'ms_kelas';
    protected $primaryKey   = 'id';
    protected $keyType      = 'int';
    public    $incrementing =  false;
    public $jenjang = 'SMP';

    public function students($tahunAjaran)
    {
        return $this->belongsToMany('App\Models\StudentSMP', 'set_siswa_kelas', 'kelas_id','nis')->where('tahunajaran',$tahunAjaran);
    }
}
