<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

class TestResource extends JsonResource
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
            'nis'=>$this->answer_code,
            ];
    }
}
