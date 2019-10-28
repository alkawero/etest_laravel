<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SoalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $soal = $this;
        $subject = $soal->subject($soal->jenjang)->first();
        
        return [    
            'id'=>$soal->id,        
            'subject_id'=> $soal->subject,         
            'subject_name'=> $subject->mapel,         
            'jenjang'=>$soal->jenjang,
            'grade_char'=>$soal->grade_char,    
            'grade_num'=>$soal->grade_num,    
            'kds'=>$soal->kds()->pluck('kd'),    
            'materis'=>$soal->kds()->pluck('materi_pokok'),    
            'ranahs'=>$soal->ranahs()->pluck('ranah_kode'),    
            'indicators'=>$soal->indicators()->pluck('indi_pencapaian'),    
            'creator_id'=>$soal->create_by,    
            'creator_name'=>$soal->creator()->value('emp_name'),    
            'type_code'=>$soal->answer_type,    
            'type_name'=>$soal->type()->value('value'),    
            'status'=>$soal->status,    
            'active'=>$soal->active, 
             
        ];
        
    }
}
