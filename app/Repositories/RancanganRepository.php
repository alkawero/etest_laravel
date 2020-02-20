<?php

namespace App\Repositories;

use App\Models\Option;
use App\Models\Soal;
use App\Models\Rancangan;
use App\Models\RancanganReviewer;
use App\Models\RancanganSoal;
use App\Models\SubjectReviewer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class RancanganRepository
{

    protected $rancangan;
    protected $rancanganSoal;


    public function __construct(Rancangan $rancangan, RancanganSoal $rancanganSoal)
    {
        $this->rancangan = $rancangan;
        $this->rancanganSoal = $rancanganSoal;
    }

    public function getByParams($params)
    {
        //DB::enableQueryLog(); // Enable query log
        $rancanganForReviewer = RancanganReviewer::where('user_id',$params->user_id)->pluck('rancangan_id');

        $query =  $this->rancangan
            ->when(
                $params->is_not_reviewer,
                function ($query) use ($params) {
                    $query->where(function ($query) use ($params) {
                        return $query
                            ->where('creator', $params->user_id)
                            ->orWhere('partner_id', $params->user_id);
                    });
                }
            )
            ->when(
                $params->is_reviewer,
                function ($query) use ($rancanganForReviewer) {
                    $query->where(function ($query) use ($rancanganForReviewer) {
                        return $query
                            ->orWhereIn('id', $rancanganForReviewer)
                            ->where('status','<>',0);
                    });
                }
            )
            ->when($params->jenjang, function ($query) use ($params) {
                return $query->where('jenjang', $params->jenjang);
            })
            ->when($params->grade_num, function ($query) use ($params) {
                return $query->where('grade_num', $params->grade_num);
            })
            ->when($params->grade_char, function ($query) use ($params) {
                return $query->where('grade_char', $params->grade_char);
            })
            ->when($params->subject, function ($query) use ($params) {
                return $query->where('subject', $params->subject);
            })
            ->when($params->external, function ($query) use ($params) {
                return $query->where('external', $params->external);
            })
            ->when($params->partner, function ($query) use ($params) {
                return $query->where('partner_id', $params->partner);
            })
            ->when($params->exam_type, function ($query) use ($params) {
                return $query->where('exam_type_code', $params->exam_type);
            })
            ->when($params->creator, function ($query) use ($params) {
                return $query->where('creator', $params->creator);
            })
            ->when($params->tahun_ajaran, function ($query) use ($params) {
                return $query->where('tahun_ajaran_char', $params->tahun_ajaran);
            })
            ->when($params->status, function ($query) use ($params) {
                return $query->where('status', $params->status);
            })
            ->where('status','<>',11);
        return $query;
        //dd(DB::getQueryLog());
    }

    public function getRancangan()
    {
        return $this->rancangan;
    }

    public function create(Request $request)
    {
        $rancangan = new Rancangan();
        $rancangan->creator = $request->creator;
        $rancangan->title = $request->title;
        $rancangan->status = $request->status;
        $rancangan->tahun_ajaran_char = $request->tahun_ajaran_char;
        $rancangan->soal_quota = $request->soal_quota;
        $rancangan->quota_composition = $request->quota_composition;
        $rancangan->subject = $request->subject;
        $rancangan->grade_char = $request->grade_char;
        $rancangan->grade_num = $request->grade_num;
        $rancangan->jenjang = $request->jenjang;
        $rancangan->collaboration_type = $request->collaboration_type;
        $rancangan->partner_id = $request->partner;
        $rancangan->exam_type_code = $request->exam_type_code;
        $rancangan->mc_composition = $request->mc_composition;
        $rancangan->es_composition = $request->es_composition;
        $rancangan->mc_creator = $request->mc_creator;
        $rancangan->es_creator = $request->es_creator;
        $rancangan->mc_partner = $request->mc_partner;
        $rancangan->es_partner = $request->es_partner;
        $rancangan->save();

        foreach ($request->soals as $soal) {
            $rancangan->soals()->syncWithoutDetaching([$soal['id'] => [
                'bobot' => $soal['bobot'],
                'soal_num' => $soal['soal_num'],
                'add_by' => $soal['add_by']
            ]]);
        }
    }

    public function sendToReviewer(Request $request)
    {

        $rancangan = Rancangan::find($request->id);

        $rancangan->status = $request->status;

        $reviewers = SubjectReviewer::where('subject_id', $rancangan->subject)
            ->where('jenjang', $rancangan->jenjang)->get();

        foreach ($reviewers as $reviewer) {
            DB::table('rancangan_reviewer')->updateOrInsert(
                ['user_id' => $reviewer->user_id, 'rancangan_id' => $rancangan->id],
                ['updated_at' => Carbon::now()]
            );
        }

        $saved =  $rancangan->save();
    }



    public function update(Request $request)
    {
        $rancangan = Rancangan::find($request->id);
        $rancangan->title = $request->title;
        $rancangan->status = $request->status;
        $rancangan->tahun_ajaran_char = $request->tahun_ajaran_char;
        $rancangan->soal_quota = $request->soal_quota;
        $rancangan->quota_composition = $request->quota_composition;
        $rancangan->subject = $request->subject;
        $rancangan->grade_char = $request->grade_char;
        $rancangan->grade_num = $request->grade_num;
        $rancangan->jenjang = $request->jenjang;
        $rancangan->collaboration_type = $request->collaboration_type;
        $rancangan->partner_id = $request->partner;
        $rancangan->exam_type_code = $request->exam_type_code;
        $rancangan->mc_composition = $request->mc_composition;
        $rancangan->es_composition = $request->es_composition;
        $rancangan->mc_creator = $request->mc_creator;
        $rancangan->es_creator = $request->es_creator;
        $rancangan->mc_partner = $request->mc_partner;
        $rancangan->es_partner = $request->es_partner;
        $rancangan->save();

        $this->rancanganSoal->where('rancangan_id', $rancangan->id)->delete();

        foreach ($request->soals as $soal) {
            $rancangan->soals()->syncWithoutDetaching([$soal['id'] => [
                'bobot' => $soal['bobot'],
                'soal_num' => $soal['soal_num'],
                'add_by' => $soal['add_by']
            ]]);
        }
    }

    public function delete($id)
    {
        //DB::table('options')->where('soal_id', $id)->delete();

        return $this->changeStatus($id,11);
    }

    public function toggle($id, $active)
    {
        $saved = Rancangan::where('id', $id)
            ->update([
                'active' => $active
            ]);
        return $saved;
    }

    public function changeStatus($id, $status)
    {
        $saved = Rancangan::where('id', $id)
            ->update([
                'status' => $status
            ]);
        return $saved;
    }



    public function getById($id)
    {
        return Rancangan::find($id);
    }
}
