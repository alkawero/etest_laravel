<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NoteController extends Controller
{

    protected $noteRepo;

    public function __construct(NoteRepository $noteRepo)
    {
        $this->noteRepo = $noteRepo;
    }

        public function getByParams(Request $request)
    {
        return NoteResource::collection($this->noteRepo->getByParams($request)->get());

    }

    public function create(Request $request){
        $saved = $this->noteRepo->create($request);
        return Response::json(['success' => $saved], 200);
    }



}
