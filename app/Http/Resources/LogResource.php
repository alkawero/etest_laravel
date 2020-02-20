<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $log = $this;
        //return ["test"=>print_r($log->resource->case()->first())];
        $user = $log->user()->first();
        $case = $log->case()->first();

        return [
            'id'=>$log->id,
            'user_id'=>$user->emp_id,
            'user_name'=>$user->emp_name,
            'case'=>$case->value,
            'data'=>$log->data,
            'object_id'=>$log->object_id,
            'created_at'=>date_format($log->created_at, 'Y-m-d H:i:s'),
            ];
    }
}
