<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KelasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->jenjang==='SD'){
            $name = $this->paralel;
            $description = $this->paralel;
        }else if($this->jenjang==='SMP'){
            $name = $this->kelas.' '.$this->paralel;
            $description = $this->kelas.' '.$this->paralel;
        }else{
            $name = $this->keterangan;
            $description = $this->keterangan;
        }
        return [
            'id'=>$this->id,
            'name'=>$name,
            'description'=>$description,
        ];
    }
}
