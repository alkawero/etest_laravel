<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function subject($jenjang){
        if($jenjang==='SD'){
            return $this->belongsTo('App\Models\mapelSD', 'subject');
        }else 
        if($jenjang==='SMP'){
            return $this->belongsTo('App\Models\mapelSMP', 'subject');
        }else{
            return $this->belongsTo('App\Models\MapelSMA', 'subject');
        }
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator','emp_id')->select('emp_id','emp_name');
        
    }

    public function pengawas()
    {
        return $this->belongsTo('App\Models\User', 'pengawas','emp_id')->select('emp_id','emp_name');
        
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Parameter', 'status', 'num_code')->where('group','exam_status');
        
    }

    public function semester()
    {
        return $this->belongsTo('App\Models\Parameter', 'semester', 'num_code')->where('group','semester');
        
    }

    public function exam_type()
    {
        return $this->belongsTo('App\Models\Parameter', 'exam_type', 'num_code')->where('group','exam_type');
        
    }

    public function rancangan()
    {
        return $this->belongsTo('App\Models\Rancangan', 'rancangan_id');
        
    }
}
