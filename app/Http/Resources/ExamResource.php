<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $exam = $this;
        $subject = $exam->subject($exam->jenjang)->first();
        $rancangan = $exam->rancangan()->first();
        $rancanganObject = new stdClass();
        $rancanganObject->id = $rancangan->id;
        $rancanganObject->jenjang = $rancangan->jenjang;
        $rancanganObject->grade_num = $rancangan->grade_num;
        $rancanganObject->exam_type = $rancangan->exam_type()->first();
        $rancanganObject->subject_name = $rancangan->subject($rancangan->jenjang)->first()->mapel;

        return [    
            'id'=>$exam->id,        
            'exam_type'=>$exam->exam_type()->first(),   
            'subject_id'=> $exam->subject,         
            'subject_name'=> $subject->mapel,         
            'jenjang'=>$exam->jenjang,
            'grade_char'=>$exam->grade_char,    
            'grade_num'=>$exam->grade_num,    
            'creator'=>$exam->creator()->first(),    
            'tahun_ajaran_char'=>$exam->tahun_ajaran_char,    
            'semester'=>$exam->semester()->first(),
            'status'=>$exam->status()->first(),
            'pengawas'=>$exam->pengawas()->first(),    
            'schedule_date'=>$exam->schedule_date,
            'start_time'=>$exam->start_time,
            'end_time'=>$exam->end_time,
            'duration'=>$exam->duration,
            'rancangan'=>$rancanganObject,
            'created_at'=>$exam->created_at];
    }
}
