<?php

namespace App\Repositories;

use App\Models\Exam;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class ExamRepository {

        protected $exam;
    

    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
    }

    public function getByParams($params)
    {    
        //DB::enableQueryLog(); // Enable query log
        $query =  $this->exam
        ->when($params->jenjang, function ($query) use ($params) {
            return $query->where('jenjang',$params->jenjang);
        })
        ->when($params->grade_num, function ($query) use ($params) {
            return $query->where('grade_num',$params->grade_num);
        })
        ->when($params->grade_char, function ($query) use ($params) {
            return $query->where('grade_char',$params->grade_char);
        })
        ->when($params->subject, function ($query) use ($params) {
            return $query->where('subject',$params->subject);
        })
        ->when($params->status, function ($query) use ($params) {
            return $query->where('status',$params->status);
        })
        ->when($params->ruangan, function ($query) use ($params) {
            return $query->where('id_ruangan',$params->ruangan);
        })
        ->when($params->exam_type, function ($query) use ($params) {
            return $query->where('exam_type',$params->exam_type);
        })
        ->when($params->creator, function ($query) use ($params) {
            return $query->where('creator',$params->creator);
        })
        ->when($params->schedule_date, function ($query) use ($params) {
            return $query->whereDate('schedule_date',$params->schedule_date);
        })
        ->when($params->start_time, function ($query) use ($params) {
            return $query->where('start_time','>=',$params->start_time);
        })
        ->when($params->end_time, function ($query) use ($params) {
            return $query->where('end_time','<=',$params->end_time);
        })
        ; 
        return $query;
        //dd(DB::getQueryLog());       
    }
    
    public function getRancangan()
    {
        return $this->rancangan;
    }

    public function create(Request $request){
        $rancangan = new Rancangan();
        $rancangan->creator = $request->creator;
        $rancangan->status = $request->status;
        $rancangan->tahun_ajaran_char = $request->tahun_ajaran_char;
        $rancangan->soal_quota = $request->soal_quota;
        $rancangan->quota_composition = $request->quota_composition;
        $rancangan->subject = $request->subject;
        $rancangan->grade_char = $request->grade_char;
        $rancangan->grade_num = $request->grade_num;
        $rancangan->jenjang = $request->jenjang;
        $rancangan->collaboration_type = $request->collaboration_type;
        $rancangan->partner = $request->partner;
        $rancangan->partner_quota = $request->partner_quota;
        $rancangan->exam_type_code = $request->exam_type_code;
        $rancangan->mc_composition = $request->mc_composition;
        $rancangan->es_composition = $request->es_composition;
        $rancangan->save();  
        
        foreach ($request->soals as $soal) {
            $rancangan->soals()->syncWithoutDetaching([$soal['id']=>[
                'bobot'=>$soal['bobot'],
                'soal_num'=>$soal['soal_num'],
                'add_by'=>$soal['add_by']]]);
        }
        
    
        
    }


    public function update(Request $request){
        $rancangan = Rancangan::find($request->id);
        $rancangan->creator = $request->creator;
        $rancangan->status = $request->status;
        $rancangan->tahun_ajaran_char = $request->tahun_ajaran_char;
        $rancangan->soal_quota = $request->soal_quota;
        $rancangan->quota_composition = $request->quota_composition;
        $rancangan->subject = $request->subject;
        $rancangan->grade_char = $request->grade_char;
        $rancangan->grade_num = $request->grade_num;
        $rancangan->jenjang = $request->jenjang;
        $rancangan->collaboration_type = $request->collaboration_type;
        $rancangan->partner = $request->partner;
        $rancangan->partner_quota = $request->partner_quota;
        $rancangan->exam_type_code = $request->exam_type_code;
        $rancangan->mc_composition = $request->mc_composition;
        $rancangan->es_composition = $request->es_composition;
        $rancangan->save();

        $this->rancanganSoal->where('rancangan_id',$rancangan->id)->delete();

        foreach ($request->soals as $soal) {
            $rancangan->soals()->syncWithoutDetaching([$soal['id']=>[
                'bobot'=>$soal['bobot'],
                'soal_num'=>$soal['soal_num'],
                'add_by'=>$soal['add_by']]]);
        }
        
        
        
        
    }

    public function delete($id){
        DB::table('options')->where('soal_id', $id)->delete();
        $deleted = Rancangan::destroy($id);                  
        return $deleted;            
    }

    public function toggle($id,$active){        
        $saved = Rancangan::where('id', $id)
            ->update([
            'active' => $active
            ]);
            return $saved;
    }

    public function getById($id){
        return Rancangan::find($id);                    
    }
}