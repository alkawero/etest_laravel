<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogResource;
use App\Http\Resources\ParamResource;
use App\Repositories\LogRepository;
use App\Repositories\ParamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LogController extends Controller
{

    protected $logRepo;


    public function __construct(LogRepository $logRepo)
    {
        $this->logRepo = $logRepo;

    }

    public function getByParams(Request $request){
        $query = $this->logRepo->getByParams($request->all());
        if($request->pageNum){
            return LogResource::collection($query->paginate($request->pageNum));
            //return new LogResource($query->paginate($request->pageNum));
        }

        //
        return $query->get();
    }

}
