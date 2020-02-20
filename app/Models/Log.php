<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id','emp_id')->select('emp_id','emp_name');
    }

    public function case()
    {
        return $this->belongsTo('App\Models\Parameter', 'case_code', 'num_code')->where('group','log_case');
    }
}
