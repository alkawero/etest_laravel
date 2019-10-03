<?php
namespace App\Repositories;

use App\Models\AdmRanah;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class RanahRepository{
    protected $admRanah;

    public function __construct(AdmRanah $admRanah)
    {
        $this->admRanah = $admRanah;        
    }

    public function getByParam($params){        
        $query =  DB::table('teacher_adm.ms_ranah')
        ->when(isset($params['ranah_kode']), function ($query) use ($params) {
            return $query->where('ranah_kode',$params['ranah_kode']);
        })
        ;                
        return $query;
    }


    
       

    
}
