<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'status'=>$exam->status()->first(),
            'pengawas'=>$exam->pengawas()->first(),    
            'schedule_date'=>$exam->schedule_date,
            'start_time'=>$exam->start_time,
            'end_time'=>$exam->end_time,
            'created_at'=>$exam->created_at];
    }
}
