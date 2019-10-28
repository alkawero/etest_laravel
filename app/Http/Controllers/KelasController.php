<?php

namespace App\Http\Controllers;

use App\Http\Resources\KelasResource;
use App\Http\Resources\StudentResource;
use App\Repositories\KelasRepository;
use Illuminate\Http\Request;

class KelasController extends Controller
{

    protected $kelasRepo;

    public function __construct(KelasRepository $kelasRepo)
    {
        $this->kelasRepo = $kelasRepo;

    }

    public function getKelas(Request $request){

        return KelasResource::collection($this->kelasRepo->getKelas($request)->get());

    }

    public function getKelasByGrade(Request $request){

        if($request->jenjang){
            switch ($request->jenjang) {
                case 'SD':
                    return KelasResource::collection($this->kelasRepo->getKelasSDByGrade($request->grade_num)->get());
                    break;
                case 'SMP':
                    return KelasResource::collection($this->kelasRepo->getKelasSMPByGrade($request->grade_num)->get());
                    break;
                case 'SMA':
                    return KelasResource::collection($this->kelasRepo->getKelasSMAByGrade($request->grade_char)->get());
                    break;
                default:
                    break;
            }
        }

    }

    public function getStudents(Request $request){
            switch ($request->jenjang) {
                case 'SD':
                    return StudentResource::collection($this->kelasRepo->getStudentSD($request->kelas_id)->get());
                    break;
                case 'SMP':
                    return StudentResource::collection($this->kelasRepo->getStudentSMP($request->kelas_id)->get());
                    break;
                case 'SMA':
                    return StudentResource::collection($this->kelasRepo->getStudentSMA($request->kelas_id)->get());
                    break;
                default:
                    break;
            }




    }

    public function getStudentsFromArrayClass(Request $request){

        switch ($request->jenjang) {
            case 'SD':
            //return $this->kelasRepo->getStudentsSDFromArrayClass(json_decode($request->ids,true))->all();
            //return var_dump($this->kelasRepo->getStudentsSDFromArrayClass(json_decode($request->ids,true)));
            return StudentResource::collection($this->kelasRepo->getStudentsSDFromArrayClass(json_decode($request->ids,true)));
                break;
            case 'SMP':
            return StudentResource::collection($this->kelasRepo->getStudentsSMPFromArrayClass(json_decode($request->ids,true)));
                break;
            case 'SMA':
            return StudentResource::collection($this->kelasRepo->getStudentsSMAFromArrayClass(json_decode($request->ids,true))->get());
                break;
            default:
                break;
        }
        }
}
