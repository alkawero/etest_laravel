<?php
namespace App\Repositories;

use App\Models\AdmKd;
use App\Models\AdmMapel;
use App\Models\AdmTrxKdIndi;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class KdRepository{
    protected $admMapel;
    protected $admKd;
    protected $admTrxKdIndi;

    public function __construct(AdmMapel $admMapel, AdmKd $admKd, AdmTrxKdIndi $admTrxKdIndi)
    {
        $this->admMapel = $admMapel;
        $this->admKd = $admKd;
        $this->admTrxKdIndi = $admTrxKdIndi;
    }

    public function getKd($params){        
        $mapel = $this->admMapel
        ->where('sistem_nilai_mapel_id',$params->subject) 
        ->where('jenjang',$params->jenjang)->first(); 
        $kis = [];
        if($mapel!=null)
        $kis = $mapel->kis()
        ->where('ki',$params->ki)
        ->whereHas('kelas', function (Builder $query) use ($params) {
            $query->where('kelas',$params->grade );
        })->pluck('id'); 
        return $this->admKd->whereIn('ki_id',$kis);
    }

    public function getRanahByKd($params){                        
        return $this->admTrxKdIndi->whereIn('kd_id',$params->kd_ids)
                                ->with('ranah')
                                ->groupBy('indi_ranah');
    }

    public function getIndicator($params){                        
        return $this->admTrxKdIndi->whereIn('kd_id',$params->kd_ids)
                                ->whereIn('indi_ranah',$params->ranah_codes);
    }
        


    
       

    
}
