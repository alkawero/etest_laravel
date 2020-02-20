<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

class ExamSelectResource extends JsonResource
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
        $exam_type = $exam->exam_type()->first();
        $activity = $exam->activity()->first();

        return [
            'value'=>$exam->id,
            'label'=>$exam_type->value."-".$subject->mapel."-".$activity->value
            ];
    }
}
