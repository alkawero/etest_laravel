<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamResource;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        
        return ExamResource::collection($this->examRepo->getByParams($request)->get());        
        
    }

    public function create(Request $request){
        $saved = $this->examRepo->create($request);
        return Response::json(['success' => $saved], 200);
    }

    public function update(Request $request){
        $updated = $this->examRepo->update($request);
        return Response::json(['success' => $updated], 200);
    }

    public function delete(Request $request){
        $deleted = $this->examRepo->delete($request->id);
        return Response::json(['success' => $deleted], 200);
        
    }

    public function toggle(Request $request){        
        $saved = $this->examRepo->toggle($request->id, $request->status);
        return Response::json(['success' => $saved], 200);
    }

    public function updateActivity(Request $request){        
        $saved = $this->examRepo->updateActivity($request->id, $request->activity);
        return Response::json(['success' => $saved], 200);
    }

    public function getById($id){
        return new ExamResource($this->examRepo->getById($id));                    
    }
}
