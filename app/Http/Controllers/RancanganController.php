<?php

namespace App\Http\Controllers;

use App\Http\Resources\RancanganResource;
use App\Repositories\RancanganRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RancanganController extends Controller
{
    protected $rancanganRepo;

    public function __construct(RancanganRepository $rancanganRepo)
    {
        $this->rancanganRepo = $rancanganRepo;
        
    }

    public function getByParams(Request $request)
    {     
        if($request->pageNum)
        return RancanganResource::collection($this->rancanganRepo->getByParams($request)->paginate($request->pageNum));        
        
        return RancanganResource::collection($this->rancanganRepo->getByParams($request)->get());        
        
    }

    public function create(Request $request){
        $saved = $this->rancanganRepo->create($request);
        return Response::json(['success' => $saved], 200);
    }

    public function update(Request $request){
        $updated = $this->rancanganRepo->update($request);
        return Response::json(['success' => $updated], 200);
    }

    public function delete(Request $request){
        $deleted = $this->rancanganRepo->delete($request->id);
        return Response::json(['success' => $deleted], 200);
        
    }

    public function toggle(Request $request){        
        $saved = $this->rancanganRepo->toggle($request->id, $request->active);
        return Response::json(['success' => $saved], 200);
    }

    public function getById($id){
        return new RancanganResource($this->rancanganRepo->getById($id));                    
    }
}
