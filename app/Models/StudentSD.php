<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSD extends Model
{
    protected $connection   = 'nilai_sdk13';
    protected $table        = 'set_siswa_kelas';
    protected $primaryKey   = 'nis';
    protected $keyType      = 'int';
    public    $incrementing =  false;
    public $jenjang = 'SD';

    public function kelas($tahunAjaran)
    {
        return $this->belongsTo('App\Models\KelasSD', 'kelas_id');
    }
}
