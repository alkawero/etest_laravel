<?php

namespace App\Http\Controllers;

use App\Repositories\UtilityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UtilityController extends Controller
{

    protected $utilRepo;

    public function __construct(UtilityRepository $utilRepo)
    {
        $this->utilRepo = $utilRepo;

    }
    public function getMathFormula(Request $request){
        if($request->pageNum)
        return $this->utilRepo->getMathFormula()->paginate($request->pageNum);

        return $this->utilRepo->getMathFormula()->all();
    }


    public function updateMathFormula(Request $request){
        $saved = $this->utilRepo->updateMathFormula($request);
        return Response::json(['success' => $saved], 200);
    }

    public function createMathFormula(Request $request){
        $saved = $this->utilRepo->createMathFormula($request);
        return Response::json(['success' => $saved], 200);

    }





}
