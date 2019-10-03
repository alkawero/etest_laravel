<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'value'=>$this->value,
            'group'=>$this->group,
            'num_code'=>$this->num_code,
            'char_code'=>$this->char_code,
            'desc'=>$this->desc,
            'status'=>$this->status,            

        ];
    }
}
