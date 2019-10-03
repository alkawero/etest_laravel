<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParamResource;
use App\Repositories\ParamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ParamController extends Controller
{
    
    protected $paramRepo;
    

    public function __construct(ParamRepository $paramRepo)
    {
        $this->paramRepo = $paramRepo;
        
    }

    public function create(Request $request){         
        $saved = $this->paramRepo->create($request);
        if($saved){
            return Response::json(['success' => $saved], 200);
        } 
    }

    public function getByParams(Request $request){                
        $query = $this->paramRepo->getByParams($request->all());
        if($request->pageNum){
            return $query->paginate($request->pageNum);    
        }
        if($request->single){
            return new ParamResource($query->first());
        }
        return $query->get();
    }
    public function getById($id){
        return $this->paramRepo->getById($id);                    
    }

    public function getGroups(){
        return $this->paramRepo->getGroups();
    }

    public function delete(Request $request){
        $deleted = $this->paramRepo->delete($request->id);
        return Response::json(['success' => $deleted], 200);        
    }

    public function toggle(Request $request){        
        $saved = $this->paramRepo->toggle($request->id, $request->status);
        return Response::json(['success' => $saved], 200);
    }

    public function update(Request $request){
        $saved = $this->paramRepo->update($request);
        return Response::json(['success' => $saved], 200);
    }

    
}
