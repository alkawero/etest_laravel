<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoalDetailResource;
use App\Http\Resources\SoalResource;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Repositories\SoalRepository;
use Illuminate\Support\Facades\Response;

class SoalController extends Controller
{
    protected $soalRepo;

    public function __construct(SoalRepository $soalRepo)
    {
        $this->soalRepo = $soalRepo;

    }

    public function getByParams(Request $request)
    {
        if($request->pageNum)
        return SoalResource::collection($this->soalRepo->getByParams($request)->paginate($request->pageNum));

        return SoalResource::collection($this->soalRepo->getByParams($request)->get());

    }

    public function create(Request $request){
        $saved = $this->soalRepo->create($request);
        return Response::json(['success' => $saved], 200);
    }

    public function update(Request $request){
        $updated = $this->soalRepo->update($request);
        return Response::json(['success' => $updated], 200);
    }

    public function saveImageOption(Request $request){
        $link = $this->soalRepo->saveImageOption($request);
        return $link;
    }


    public function delete(Request $request){
        $deleted = $this->soalRepo->delete($request->id);
        return Response::json(['success' => $deleted], 200);

    }

    public function toggle(Request $request){
        $saved = $this->soalRepo->toggle($request->id, $request->active);
        return Response::json(['success' => $saved], 200);
    }

    public function getById($id){
        return new SoalDetailResource($this->soalRepo->getById($id));
    }




}
