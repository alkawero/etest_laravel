<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndiSelectionResource;
use App\Http\Resources\KdSelectionResource;
use App\Http\Resources\RanahSelectionResource;
use App\Repositories\KdRepository;
use Illuminate\Http\Request;

class KdController extends Controller
{

    protected $kdRepo;

    public function __construct(KdRepository $kdRepo)
    {
        $this->kdRepo = $kdRepo;
        
    }

    public function getKd(Request $request){
        $query = $this->kdRepo->getKd($request);
        if($request->selection){
            return KdSelectionResource::collection($query->get());
        }
        return $query->get();
    }

    public function getRanahByKd(Request $request){
        $query = $this->kdRepo->getRanahByKd($request);
        
        if($request->selection){            
            return RanahSelectionResource::collection($query->get());
        }
        return $query->get();
    }

    public function getIndicator(Request $request){
        $query = $this->kdRepo->getIndicator($request);        
        if($request->selection){            
            return IndiSelectionResource::collection($query->get());
        }
        return $query->get();
    }
}
