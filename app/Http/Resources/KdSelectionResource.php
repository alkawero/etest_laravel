<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KdSelectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $semester = $this->ki()->value('semester');
        return [
            'id'=>$this->id,
            'semester'=>$semester,
            'kd'=>$this->kd,
            'kd_desc'=>$this->kd_desc          
        ];
    }
}
