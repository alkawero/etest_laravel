<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamResource;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected $examRepo;

    public function __construct(ExamRepository $examRepo)
    {
        $this->examRepo = $examRepo;
        
    }

    public function getByParams(Request $request)
    {     
        if($request->pageNum)
        return ExamResource::collection($this->examRepo->getByParams($request)->paginate($request->pageNum));        
        
        return $this->examRepo->getByParams($request);        
        
    }
}
