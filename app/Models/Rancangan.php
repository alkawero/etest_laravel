<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rancangan extends Model
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
        return $this->belongsTo('App\Models\User', 'creator','emp_id');

    }

    public function quota_composition()
    {
        return $this->belongsTo('App\Models\Parameter', 'quota_composition', 'char_code')->where('group','quota_composition');

    }

    public function collaboration_type()
    {
        return $this->belongsTo('App\Models\Parameter', 'collaboration_type', 'char_code')->where('group','collaboration_type');

    }

    public function status()
    {
        return $this->belongsTo('App\Models\Parameter', 'status', 'num_code')->where('group','rancangan_status');

    }

    public function exam_type()
    {
        return $this->belongsTo('App\Models\Parameter', 'exam_type_code', 'num_code')->where('group','exam_type');

    }

    public function soals()
    {
        return $this->belongsToMany('App\Models\Soal','rancangan_soal','rancangan_id','soal_id')->withPivot('bobot', 'add_by','soal_num');
    }

    public function reviewers()
    {
        return $this->belongsToMany('App\Models\User','etest_cbt_db.rancangan_reviewer','rancangan_id','user_id')->select('emp_id','emp_name');
    }

    public function partner()
    {
        return $this->belongsTo('App\Models\User', 'partner','emp_id');

    }

    public function notes()
    {
        return $this->hasMany('App\Models\Note', 'object_id')->where('note_type_code',1);

    }




}
