<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RanahSelectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $ranah = $this->ranah;
        $kdx = $this->kd;
        return [    
            'ranah_id'=>$ranah->id,        
            'kd'=> $kdx->kd,         
            'ranah_code'=>$ranah->ranah_kode,
            'ranah_ket'=>$ranah->ranah_ket,    
        ];
    }
}
