<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RancanganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $rancangan = $this;
        $subject = $rancangan->subject($rancangan->jenjang)->first();

        return [
            'id'=>$rancangan->id,
            'subject_id'=> $rancangan->subject,
            'subject_name'=> $subject->mapel,
            'jenjang'=>$rancangan->jenjang,
            'grade_char'=>$rancangan->grade_char,
            'grade_num'=>$rancangan->grade_num,
            'creator_id'=>$rancangan->creator,
            'creator_name'=>$rancangan->creator()->value('emp_name'),
            'tahun_ajaran_char'=>$rancangan->tahun_ajaran_char,
            'soal_quota'=>$rancangan->soal_quota,
            'quota_composition'=>$rancangan->quota_composition()->first(),
            'mc_composition'=>$rancangan->mc_composition,
            'es_composition'=>$rancangan->es_composition,
            'collaboration'=>$rancangan->collaboration_type()->first(),
            'status'=>$rancangan->status()->first(),
            'partner_id'=>$rancangan->partner_id,
            'partner_name'=>$rancangan->partner()->value('emp_name'),
            'partner_quota'=>$rancangan->partner_quota,
            'checked_date'=>$rancangan->checked_date,
            'approved_date'=>$rancangan->approved_date,
            'revision_duedate'=>$rancangan->revision_duedate,
            'proposed_date'=>$rancangan->proposed_date,
            'exam_type'=>$rancangan->exam_type()->first(),
            'created_at'=>$rancangan->created_at,
            'soals'=>SoalResourceRancangan::collection($rancangan->soals()->get()),
            'reviewers'=>$rancangan->reviewers()->get(),
            'title'=>$rancangan->title,
            'mc_partner'=>$rancangan->mc_partner,
            'es_partner'=>$rancangan->es_partner,
            'mc_creator'=>$rancangan->mc_creator,
            'es_creator'=>$rancangan->es_creator



        ];

    }
}
