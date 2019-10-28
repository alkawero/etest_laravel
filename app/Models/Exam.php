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

    public function activity()
    {
        return $this->belongsTo('App\Models\Parameter', 'activity', 'num_code')->where('group','exam_activity');

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

    public function kelasParticipants($jenjang){
        if($jenjang==='SD'){
            return $this->belongsToMany('App\Models\KelasSD', 'etest_cbt_db.exam_kelas_participant', 'exam_id', 'kelas_id');
        }else
        if($jenjang==='SMP'){
            return $this->belongsToMany('App\Models\KelasSMP', 'etest_cbt_db.exam_kelas_participant', 'exam_id', 'kelas_id');
        }else{
            return $this->belongsToMany('App\Models\KelasSMA', 'etest_cbt_db.exam_kelas_participant', 'exam_id', 'kelas_id');
        }
    }

    public function studentParticipants($jenjang){
        if($jenjang==='SD'){
            return $this->belongsToMany('App\Models\StudentSD', 'etest_cbt_db.exam_student_participant', 'exam_id', 'nis')->withPivot('exam_account_num','gerated_password');
        }else
        if($jenjang==='SMP'){
            return $this->belongsToMany('App\Models\StudentSMP', 'etest_cbt_db.exam_student_participant', 'exam_id', 'nis')->withPivot('exam_account_num','gerated_password');
        }else{
            return $this->belongsToMany('App\Models\StudentSMA', 'etest_cbt_db.exam_student_participant', 'exam_id', 'nis')->withPivot('exam_account_num','gerated_password');
        }
    }
}
