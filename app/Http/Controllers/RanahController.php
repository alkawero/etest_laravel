<?php

namespace App\Http\Controllers;

use App\Repositories\RanahRepository;
use Illuminate\Http\Request;

class RanahController extends Controller
{
    protected $ranahRepo;

    public function __construct(RanahRepository $ranahRepo)
    {
        $this->ranahRepo = $ranahRepo;
        
    }

    public function getByParams(Request $request){                
        $query = $this->ranahRepo->getByParams($request->all());
        
        if($request->pageNum){
            return $query->paginate($request->pageNum);    
        }
        if($request->single){
            return $query->first();
        }
        return $query->get();
    }
}
