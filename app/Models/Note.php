<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    public function from()
    {
        return $this->belongsTo('App\Models\User', 'from','emp_id');

    }

    public function to()
    {
        return $this->belongsTo('App\Models\User', 'to_person','emp_id');

    }

    public function type()
    {
        return $this->belongsTo('App\Models\Parameter', 'note_type_code', 'num_code')->where('group','note_type')->select('num_code','value');

    }
}
