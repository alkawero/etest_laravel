<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectReviewResouce;
use App\Repositories\SubjectReviewerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SubjectReviewerController extends Controller
{

    protected $srRepo;

    public function __construct(SubjectReviewerRepository $srRepo)
    {
        $this->srRepo = $srRepo;

    }

    public function getByParams(Request $request)
    {
        if($request->pageNum)
        return SubjectReviewResouce::collection($this->srRepo->getByParams($request)->paginate($request->pageNum));

        return SubjectReviewResouce::collection($this->srRepo->getByParams($request)->get());

    }

    public function create(Request $request){
        $saved = $this->srRepo->create($request);
        return Response::json(['success' => $saved], 200);
    }

    public function update(Request $request){
        $saved = $this->srRepo->update($request);
        return Response::json(['success' => $saved], 200);
    }

    public function delete(Request $request){
        $deleted = $this->srRepo->delete($request->id);
        return Response::json(['success' => $deleted], 200);

    }
}
