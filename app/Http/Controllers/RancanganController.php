<?php

namespace App\Http\Controllers;

use App\Http\Resources\RancanganResource;
use App\Repositories\LogRepository;
use App\Repositories\RancanganRepository;
use App\Repositories\SubjectReviewerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RancanganController extends Controller
{
    protected $rancanganRepo;
    protected $logRepo;
    protected $subjectReviewerRepository;

    public function __construct(LogRepository $logRepo,RancanganRepository $rancanganRepo, SubjectReviewerRepository $subjectReviewerRepository)
    {
        $this->rancanganRepo = $rancanganRepo;
        $this->logRepo = $logRepo;
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
        $this->logRepo->create($request->sender,1,"send to reviewer",$request->id);
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

    public function changeToRevision(Request $request){
        $saved = $this->rancanganRepo->changeStatus($request->id, 4);
        $this->logRepo->create($request->revise_by,2,$request->notes,$request->id);
        return Response::json(['success' => $saved], 200);
    }

    public function changeToReject(Request $request){
        $saved = $this->rancanganRepo->changeStatus($request->id, 5);
        $this->logRepo->create($request->reject_by,3,$request->notes,$request->id);
        return Response::json(['success' => $saved], 200);
    }

    public function changeToApprove(Request $request){
        $saved = $this->rancanganRepo->changeStatus($request->id, 3);
        $this->logRepo->create($request->approve_by,4,"aprroved by reviewer",$request->id);
        return Response::json(['success' => $saved], 200);
    }



    public function getById($id){
        return new RancanganResource($this->rancanganRepo->getById($id));
    }


}
