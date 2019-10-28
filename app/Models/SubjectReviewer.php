<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectReviewer extends Model
{
    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'user_id','emp_id');
    }

    public function subject($jenjang){
        if($jenjang==='SD'){
            return $this->belongsTo('App\Models\mapelSD', 'subject_id');
        }else
        if($jenjang==='SMP'){
            return $this->belongsTo('App\Models\mapelSMP', 'subject_id');
        }else{
            return $this->belongsTo('App\Models\MapelSMA', 'subject_id');
        }
    }


}
