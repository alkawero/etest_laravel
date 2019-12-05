<?php

namespace App\Http\Controllers;

use App\Http\Resources\RancanganResource;
use App\Repositories\RancanganRepository;
use App\Repositories\SubjectReviewerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RancanganController extends Controller
{
    protected $rancanganRepo;
    protected $subjectReviewerRepository;

    public function __construct(RancanganRepository $rancanganRepo, SubjectReviewerRepository $subjectReviewerRepository)
    {
        $this->rancanganRepo = $rancanganRepo;
        $this->subjectReviewerRepository = $subjectReviewerRepository;

    }

    public function getByParams(Request $request)
    {
        $reviewer = $this->subjectReviewerRepository->getByUserId($request->user_id)->first();
        if($reviewer)
        $request->is_reviewer=true;
        else
        $request->is_not_reviewer=true;

        if($request->pageNum)
        return RancanganResource::collection($this->rancanganRepo->getByParams($request)->paginate($request->pageNum));

        return RancanganResource::collection($this->rancanganRepo->getByParams($request)->get());

    }

    public function create(Request $request){
        $saved = $this->rancanganRepo->create($request);
        return Response::json(['success' => $saved], 200);
    }

    public function sendToReviewer(Request $request){
        $saved = $this->rancanganRepo->sendToReviewer($request);
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

    public function changeStatus(Request $request){
        $saved = $this->rancanganRepo->changeStatus($request->id, $request->status);
        return Response::json(['success' => $saved], 200);
    }


    public function getById($id){
        return new RancanganResource($this->rancanganRepo->getById($id));
    }


}
