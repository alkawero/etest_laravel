<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamResource;
use App\Http\Resources\ExamDetailResource;
use App\Http\Resources\StudentResource;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade as PDF;

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

    public function getDetailById($id){
        return new ExamDetailResource($this->examRepo->getById($id));
    }

    public function getActivityStatus(Request $request){
        return $this->examRepo->getActivityStatus($request->id);
    }

    public function saveAnswer(Request $request){
        $saved = $this->examRepo->saveAnswer($request);
        return Response::json(['success' => $saved], 200);
    }

    public function getStudents(Request $request){
    return StudentResource::collection($this->examRepo->getUserParticipants($request->id)->get());
    }

    public function updateUserParticipants(Request $request){
        $saved = $this->examRepo->updateUserParticipants($request);
        return Response::json(['success' => $saved], 200);
    }

    public function printDompdfExamCard(Request $request){
        $data = $this->examRepo->getUserParticipants($request->exam_id)->get();
        $pdf = PDF::loadView('examCard',['data'=>$data]);
            $pdf->setPaper('a4' , 'portrait');
        return $pdf->download('file.pdf');
    }




}
