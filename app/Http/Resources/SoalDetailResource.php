<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SoalDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $subject = $this->subject($this->jenjang)->first();
        return [
            'id'=>$this->id,
            'external'=>$this->external,
            'subject_id'=> $this->subject,
            'subject_name'=> $subject->mapel,
            'jenjang'=>$this->jenjang,
            'grade_char'=>$this->grade_char,
            'grade_num'=>$this->grade_num,
            'kds'=>$this->kds()->get(),
            'materis'=>$this->kds()->get(),
            'ranahs'=>$this->ranahs()->get(),
            'indicators'=>$this->indicators()->get(),
            'creator_id'=>$this->create_by,
            'creator_name'=>$this->creator()->pluck('emp_name'),
            'type_code'=>$this->answer_type,
            'type_name'=>$this->type()->value('value'),
            'level'=>$this->level()->first(),
            'source'=>$this->source,
            'answer_type'=>$this->answer_type,
            'content_type'=>$this->content_type,
            'content'=>$this->content,
            'question_type'=>$this->question_type,
            'question'=>$this->question,
            'options'=>$this->options()->get(),
            'status'=>$this->status,
            'active'=>$this->active,
            'right_answer'=>$this->right_answer,
            'extra'=>  $this->pivot,
        ];
    }
}
