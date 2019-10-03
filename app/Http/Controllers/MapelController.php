<?php

namespace App\Http\Controllers;

use App\Http\Resources\MapelSDResource;
use App\Http\Resources\MapelSMAResource;
use App\Http\Resources\MapelSMPResource;
use App\Repositories\MapelRepository;
use Illuminate\Http\Request;

class MapelController extends Controller
{

    protected $mapelRepo;

    public function __construct(MapelRepository $mapelRepo)
    {
        $this->mapelRepo = $mapelRepo;
        
    }

    public function getMapel(Request $request){        
        
        if($request->jenjang){
            switch ($request->jenjang) {
                case 'SD':
                    return MapelSDResource::collection($this->mapelRepo->getMapelSD());
                    break;
                case 'SMP':
                    return MapelSMPResource::collection($this->mapelRepo->getMapelSMP());
                    break;
                case 'SMA':
                    return MapelSMAResource::collection($this->mapelRepo->getMapelSMA());
                    break;
                default:
                    break;
            }
        }
                
    }
}
