<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    public function kds()
    {
        return $this->belongsToMany('App\Models\AdmKd', 'etest_cbt_db.soal_kd', 'soal_id', 'kd_id');
    }

    public function indicators()
    {
        return $this->belongsToMany('App\Models\AdmTrxKdIndi', 'etest_cbt_db.soal_indicator', 'soal_id', 'indi_id');
    }

    public function ranahs()
    {
        return $this->belongsToMany('App\Models\AdmRanah', 'etest_cbt_db.soal_ranah', 'soal_id', 'ranah_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'create_by','emp_id')->select('emp_id','emp_name');

    }

    public function type()
    {
        return $this->belongsTo('App\Models\Parameter', 'answer_type', 'char_code')->where('group','answer_type');

    }

    public function level()
    {
        return $this->belongsTo('App\Models\Parameter', 'level', 'num_code')->where('group','question_level');

    }


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

    public function options(){
        return $this->hasMany('App\Models\Option', 'soal_id');
    }
}
