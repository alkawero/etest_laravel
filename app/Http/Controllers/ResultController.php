<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestResource;

use App\Http\Resources\ResultResource;
use App\Repositories\KelasRepository;
use App\Repositories\ResultRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\Snappy\Facades\SnappyPdf as SnappyPDF;
use Barryvdh\Snappy\Facades\SnappyImage as SnappyImage;

class ResultController extends Controller
{
    protected $resultRepo;
    protected $kelasRepo;

    public function __construct(ResultRepository $resultRepo, KelasRepository $kelasRepo)
    {
        $this->resultRepo = $resultRepo;
        $this->kelasRepo = $kelasRepo;
    }

    public function getResultOfNis(Request $request)
    {
        return $this->resultRepo->getResultOfNis($request->nis,$request->exam_id);
    }

    public function getResultOfKelas(Request $request)
    {
        switch ($request->jenjang) {
            case 'SD':
                $nis = $this->kelasRepo->getStudentSD($request->kelas_id)->get();
                break;
            case 'SMP':
                $nis = $this->kelasRepo->getStudentSMP($request->kelas_id)->get();
                break;
            case 'SMA':
                $nis = $this->kelasRepo->getStudentSMA($request->kelas_id)->get();
                break;
            default:
                break;
        }
        //return new TestResource($nis);
        //return TestResource::collection($this->resultRepo->getResultOfKelas($request->exam_id,$nis));
        //return ResultResource::collection($this->resultRepo->getResultOfNis($request));
        return $this->resultRepo->getResultOfKelas($request->exam_id,$nis);
    }
}
