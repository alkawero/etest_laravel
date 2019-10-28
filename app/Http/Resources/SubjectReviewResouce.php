<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectReviewResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $reviewer = $this->reviewer()->first();
        $subject = $this->subject($this->jenjang)->first();
        $subject_name = "";


        switch ($this->jenjang) {
            case 'SD':
                $subject_name = $subject->nama;
                break;
            case 'SMP':
                $subject_name = $subject->nama;
                break;
            case 'SMA':
                $subject_name = $subject->mapel;
                break;
            default:

                break;
        }


        return [
            'id'=>$this->id,
            'subject' => $subject,
            'subject_name' => $subject_name,
            'jenjang' => $this->jenjang,
            'reviewer_id' => $reviewer->emp_id,
            'reviewer_name' => $reviewer->emp_name,
        ];
    }
}
