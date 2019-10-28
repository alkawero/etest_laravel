<?php
namespace App\Repositories;

use App\Models\KelasSD;
use App\Models\KelasSMA;
use App\Models\KelasSMP;
use App\Models\Parameter;
use App\Models\StudentSMA;
use Illuminate\Support\Collection;

class KelasRepository{
    protected $kelasSD;
    protected $kelasSMP;
    protected $kelasSMA;
    protected $studentSD;
    protected $studentSMP;
    protected $studentSMA;

    public function __construct(KelasSD $kelasSD, KelasSMP $kelasSMP, KelasSMA $kelasSMA, StudentSMA $studentSMA)
    {
        $this->kelasSD = $kelasSD;
        $this->kelasSMP = $kelasSMP;
        $this->kelasSMA = $kelasSMA;
        $this->studentSMA = $studentSMA;
    }



    public function syncronize(){

    }

    public function getKelas($request){
        if($request->jenjang){
            switch ($request->jenjang) {
                case 'SD':
                    if($request->grade_num)
                    return $this->getKelasSDByGrade($request->grade_num);

                    return $this->getKelasSD();
                    break;
                case 'SMP':
                if($request->grade_num)
                    return $this->getKelasSMPByGrade($request->grade_num);

                    return $this->getKelasSMP();
                    break;
                case 'SMA':
                if($request->grade_char)
                    return $this->getKelasSMAByGrade($request->grade_char);

                    return $this->getKelasSMA();
                    break;
                default:
                    break;
            }
        }
    }

    public function getKelasSD(){
        return $this->kelasSD;
    }
    public function getKelasSMP(){
        return $this->kelasSMP;
    }
    public function getKelasSMA(){
        return $this->kelasSMA;
    }

    public function getKelasSDByGrade($grade_num){
        return $this->kelasSD->where('kelas',$grade_num);
    }
    public function getKelasSMPByGrade($grade_num){
        return $this->kelasSMP->where('kelas',$grade_num);
    }
    public function getKelasSMAByGrade($grade_char){
        return $this->kelasSMA->where('kelas',$grade_char);
    }

    public function getStudentSD($kelas_id){
        $tahunAjaran=Parameter::where('status',1)->where('group','tahun_pelajaran')->value('value');
        $kelas = $this->kelasSD->find($kelas_id);
        return $kelas->students($tahunAjaran);
    }
    public function getStudentSMP($kelas_id){
        $tahunAjaran=Parameter::where('status',1)->where('group','tahun_pelajaran')->value('value');
        $kelas = $this->kelasSMP->find($kelas_id);
        return $kelas->students($tahunAjaran);
    }
    public function getStudentSMA($kelas_id){
        $tahunAjaran=Parameter::where('status',1)->where('group','tahun_pelajaran')->value('value');
        return $this->studentSMA->where('kelas',$kelas_id)
        ->where('tahunajaran',$tahunAjaran);
    }

    public function getStudentsSDFromArrayClass($arrayClass){
        $tahunAjaran=Parameter::where('status',1)->where('group','tahun_pelajaran')->value('value');
        $kelases = KelasSD::whereIn('id',$arrayClass)->get();
        $students = new Collection();
        foreach ($kelases as $kelas) {
            $students = $students->merge($kelas->students($tahunAjaran)->get());
        }
        return $students;
    }

    public function getStudentsSMPFromArrayClass($arrayClass){
        $tahunAjaran=Parameter::where('status',1)->where('group','tahun_pelajaran')->value('value');
        $kelases = KelasSMP::whereIn('id',$arrayClass)->get();
        $students = new Collection();
        foreach ($kelases as $kelas) {
            $students = $students->merge($kelas->students($tahunAjaran)->get());
        }
        return $students;
    }

    public function getStudentsSMAFromArrayClass($arrayClass){
        $tahunAjaran=Parameter::where('status',1)->where('group','tahun_pelajaran')->value('value');
        return $this->studentSMA->whereIn('kelas',$arrayClass)
        ->where('tahunajaran',$tahunAjaran);
    }

}
