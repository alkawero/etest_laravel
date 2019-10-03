<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndiSelectionResource extends JsonResource
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
            'trx_indi_id'=> $this->id,         
            'indikator'=>$this->indi_pencapaian,
            'ranah'=>$this->indi_ranah,    
        ];
    }
}
