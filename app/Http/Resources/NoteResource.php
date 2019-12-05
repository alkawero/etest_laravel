<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $note = $this;
        $from = $note->from()->first();
        $type = $note->type()->first();
        return [
            'id'=>$note->id,
            'tittle'=> $note->tittle,
            'text'=> $note->text,
            'from_name'=>$from->emp_name,
            'from_id'=>$from->emp_id,
            'status'=>$note->status,
            'type'=>$type
        ];
    }
}
