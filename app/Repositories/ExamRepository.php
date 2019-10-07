<?php

namespace App\Repositories;

use App\Models\Exam;
use Carbon\Carbon;
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
    
    public function getExam()
    {
        return $this->exam;
    }

    public function create(Request $request){
        //return $request;
        $exam = new Exam();
        $exam->creator = $request->creator;
        $exam->status = $request->status;
        $exam->tahun_ajaran_char = $request->tahun_ajaran_char;
        $exam->rancangan_id = $request->rancangan;
        $exam->subject = $request->subject;
        $exam->grade_char = $request->grade_char;
        $exam->grade_num = $request->grade_num;
        $exam->jenjang = $request->jenjang;
        $exam->exam_type = $request->exam_type;
        $exam->schedule_date = $request->schedule_date;
        $exam->start_time = $request->start_time;
        $exam->end_time = $request->end_time;
        $exam->pengawas = $request->pengawas;
        $exam->duration = $request->duration;
        
        $exam->save();  
                        
    
        
    }


    public function update(Request $request){
        $exam = Exam::find($request->id);
        $exam->creator = $request->creator;
        $exam->status = $request->status;
        $exam->tahun_ajaran_char = $request->tahun_ajaran_char;
        $exam->soal_quota = $request->soal_quota;
        $exam->quota_composition = $request->quota_composition;
        $exam->subject = $request->subject;
        $exam->grade_char = $request->grade_char;
        $exam->grade_num = $request->grade_num;
        $exam->jenjang = $request->jenjang;
        $exam->collaboration_type = $request->collaboration_type;
        $exam->partner = $request->partner;
        $exam->partner_quota = $request->partner_quota;
        $exam->exam_type_code = $request->exam_type_code;
        $exam->mc_composition = $request->mc_composition;
        $exam->es_composition = $request->es_composition;
        $exam->save();

        $this->examSoal->where('exam_id',$exam->id)->delete();

        foreach ($request->soals as $soal) {
            $exam->soals()->syncWithoutDetaching([$soal['id']=>[
                'bobot'=>$soal['bobot'],
                'soal_num'=>$soal['soal_num'],
                'add_by'=>$soal['add_by']]]);
        }
        
        
        
        
    }

    public function delete($id){
        DB::table('options')->where('soal_id', $id)->delete();
        $deleted = Exam::destroy($id);                  
        return $deleted;            
    }

    public function toggle($id,$active){        
        $saved = Exam::where('id', $id)
            ->update([
            'active' => $active
            ]);
            return $saved;
    }

    public function getById($id){
        return Exam::find($id);                    
    }
}