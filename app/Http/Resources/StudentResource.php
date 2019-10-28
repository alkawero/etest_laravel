<?php

namespace App\Http\Resources;

use App\Models\Parameter;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $tahunAjaran=Parameter::where('status',1)->where('group','tahun_pelajaran')->value('value');
        if($this->jenjang==='SD'){

        }else if($this->jenjang==='SMP'){

        }else{

        }
        return [
            'nis' => $this->nis,
            'name'=>$this->nama,
            'kelas'=>new KelasResource($this->kelas($tahunAjaran)->first())
        ];
    }
}
