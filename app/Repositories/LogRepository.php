<?php
namespace App\Repositories;

use App\Models\Log;
use Illuminate\Support\Facades\DB;

class LogRepository{
    protected $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }



    public function create($user_id,$case_code,$data,$object_id){
        $newObj = new Log();
        $newObj->user_id = $user_id;
        $newObj->case_code = $case_code;
        $newObj->data = $data;
        $newObj->object_id = $object_id;
        $saved = $newObj->save();

        return $saved;
    }



    public function getByParams($params)
    {
        $query =  $this->log
        ->when(isset($params['user_id']), function ($query) use ($params) {
            return $query->where('user_id',$params['user_id']);
        })
        ->when(isset($params['case_code']), function ($query) use ($params) {
            return $query->where('case_code',$params['case_code']);
        })
        ->when(isset($params['case']), function ($query) use ($params) {
            return $query->where('case_code',$params['case']);
        })
        ->when(isset($params['object_id']), function ($query) use ($params) {
            return $query->where('object_id',$params['object_id']);
        });
        return $query;
    }


}
