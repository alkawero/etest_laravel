<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageIdText;

use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PageController extends Controller
{
    protected $pageRepo;
    

    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepo = $pageRepo;
        
    }
    
    public function getByParams(Request $request){        
        if($request->pageNum)
        return $this->pageRepo->getPage()->paginate($request->pageNum);        
        if($request->keyWord)
        return PageIdText::collection($this->pageRepo->getLike($request->keyWord));
    }

    
    public function getById($id){
        return $this->pageRepo->getById($id);                    
    }

    public function delete(Request $request){
        $deleted = $this->pageRepo->delete($request->id);
        return Response::json(['success' => $deleted], 200);        
    }

    

    public function create(Request $request){        
        $saved = $this->pageRepo->create($request);
        return Response::json(['success' => $saved], 200);
    }

    public function update(Request $request){        
        $saved = $this->pageRepo->update($request);
        return Response::json(['success' => $saved], 200);
        
    }

    

    public function toggle(Request $request){        
        $saved = $this->pageRepo->toggle($request->id, $request->status);
        return Response::json(['success' => $saved], 200);
    }



}
