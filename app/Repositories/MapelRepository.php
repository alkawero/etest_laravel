<?php
namespace App\Repositories;

use App\Models\Mapel;
use App\Models\MapelSD;
use App\Models\MapelSMA;
use App\Models\MapelSMP;
use App\Models\Parameter;
use Illuminate\Support\Facades\DB;

class MapelRepository{
    protected $mapel;
    protected $mapelSD;
    protected $mapelSMP;
    protected $mapelSMA;

    public function __construct(Mapel $mapel, MapelSD $mapelSD, MapelSMP $mapelSMP, MapelSMA $mapelSMA)
    {
        $this->mapel = $mapel;
        $this->mapelSD = $mapelSD;
        $this->mapelSMP = $mapelSMP;
        $this->mapelSMA = $mapelSMA;
    }


    
    public function syncronize(){        
        
    }   

    public function getMapelSD(){
        return $this->mapelSD->all();
    }
    public function getMapelSMP(){
        return $this->mapelSMP->all();
    }
    public function getMapelSMA(){
        return $this->mapelSMA->all();
    }
    
}
