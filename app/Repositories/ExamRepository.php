<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamKelasParticipant;
use App\Models\ExamStudentParticipant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class ExamRepository
{

    protected $exam;
    protected $kelasRepo;

    public function __construct(Exam $exam, KelasRepository $kelasRepo)
    {
        $this->exam = $exam;
        $this->kelasRepo = $kelasRepo;
    }

    public function getByParams($params)
    {
        //DB::enableQueryLog(); // Enable query log
        $activityNol = null;
        if ($params->activity === 0) {
            $activityNol = 'nol';
        }
        $query =  $this->exam
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
            ->when($params->status, function ($query) use ($params) {
                return $query->where('status', $params->status);
            })
            ->when($params->ruangan, function ($query) use ($params) {
                return $query->where('id_ruangan', $params->ruangan);
            })
            ->when($params->exam_type, function ($query) use ($params) {
                return $query->where('exam_type', $params->exam_type);
            })
            ->when($params->creator, function ($query) use ($params) {
                return $query->where('creator', $params->creator);
            })
            ->when($params->schedule_date, function ($query) use ($params) {
                return $query->whereDate('schedule_date', $params->schedule_date);
            })
            ->when($params->start_time, function ($query) use ($params) {
                return $query->where('start_time', '>=', $params->start_time);
            })
            ->when($params->end_time, function ($query) use ($params) {
                return $query->where('end_time', '<=', $params->end_time);
            })
            ->when($activityNol, function ($query) use ($params) {
                return $query->where('activity', intval($params->activity));
            })
            ->when($params->activity, function ($query) use ($params) {
                return $query->where('activity', intval($params->activity));
            });
        return $query;
        //dd(DB::getQueryLog());
    }

    public function getExam()
    {
        return $this->exam;
    }

    public function create(Request $request)
    {
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
        $examClass = $request->participant_class;
        foreach ($examClass as $cls) {
            $exam->kelasParticipants($request->jenjang)->syncWithoutDetaching([$cls => ['jenjang' => $request->jenjang]]);
        }





        return $exam;
    }


    public function update(Request $request)
    {
        $exam = Exam::find($request->id);
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

        ExamKelasParticipant::where('exam_id',$request->id)->delete();
        $examClass = $request->participant_class;
        foreach ($examClass as $cls) {
            $exam->kelasParticipants($request->jenjang)->syncWithoutDetaching([$cls => ['jenjang' => $request->jenjang]]);
        }

        //clear existing exam_student_participant
        DB::table('exam_student_participant')->where('exam_id', $exam->id)->delete();
        //insert into exam_student_participant
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        switch ($request->jenjang) {
            case 'SD':
            $studentsId = $this->kelasRepo->getStudentsSDFromArrayClass($examClass)->pluck('nis');
            $dataInsert = [];
            foreach ($studentsId as $id) {
                array_push($dataInsert,[
                    'nis'=>$id,
                    'exam_account_num'=>$id.$exam->id,
                    'gerated_password'=>substr( str_shuffle( $chars ), 0, 6 ),
                    'exam_id'=>$exam->id,
                ]);
            }
            DB::table('exam_student_participant')->insert($dataInsert);
                break;
            case 'SMP':
            $studentsId = $this->kelasRepo->getStudentsSMPFromArrayClass($examClass)->pluck('nis');
            $dataInsert = [];
            foreach ($studentsId as $id) {
                array_push($dataInsert,[
                    'nis'=>$id,
                    'exam_account_num'=>$id.$exam->id,
                    'gerated_password'=>substr( str_shuffle( $chars ), 0, 6 ),
                    'exam_id'=>$exam->id
                ]);
            }
            DB::table('exam_student_participant')->insert($dataInsert);
                break;
            case 'SMA':
            $studentsId = $this->kelasRepo->getStudentsSMAFromArrayClass($examClass)->pluck('nis');
            $dataInsert = [];
            foreach ($studentsId as $id) {
                array_push($dataInsert,[
                    'nis'=>$id,
                    'exam_account_num'=>$id.$exam->id,
                    'gerated_password'=>substr( str_shuffle( $chars ), 0, 6 ),
                    'exam_id'=>$exam->id
                ]);
            }
            DB::table('exam_student_participant')->insert($dataInsert);
                break;
            default:
                break;
        }

        return $exam;
    }

    public function delete($id)
    {
        DB::table('options')->where('soal_id', $id)->delete();
        $deleted = Exam::destroy($id);
        return $deleted;
    }

    public function toggle($id, $status)
    {
        $saved = Exam::where('id', $id)
            ->update([
                'status' => $status
            ]);
        return $saved;
    }

    public function updateActivity($id, $activity)
    {
        $saved = Exam::where('id', $id)
            ->update([
                'activity' => $activity
            ]);
        return $saved;
    }

    public function saveAnswer(Request $request)
    {

        $answer = ExamAnswer::where([
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'rancangan_id' => $request->rancangan_id,
            'soal_id' => $request->soal_id,
        ])->first();

        if ($answer) {
            $answer->answer_code = $request->answer_code;
            $answer->answer_text = $request->answer_text;
            return $answer->save();
        } else {
            $answer = new ExamAnswer();
            $answer->user_id = $request->user_id;
            $answer->exam_id = $request->exam_id;
            $answer->rancangan_id = $request->rancangan_id;
            $answer->soal_id = $request->soal_id;
            $answer->answer_code = $request->answer_code;
            $answer->answer_text = $request->answer_text;
            return $answer->save();
        }
    }

    public function getById($id)
    {
        return Exam::find($id);
    }

    public function getActivityStatus($id)
    {
        return Exam::where('id',$id)->value('activity');
    }


    public function getUserParticipants($id){
        $exam = Exam::find($id);
        return $exam->studentParticipants($exam->jenjang);
    }

    public function updateUserParticipants($request){
        //clear existing exam_student_participant
        DB::table('exam_student_participant')->where('exam_id', $request->exam_id)->delete();
        //insert into exam_student_participant
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        switch ($request->jenjang) {
            case 'SD':
            $studentsId = $this->kelasRepo->getStudentsSDFromArrayClass(json_decode($request->classes,true))->pluck('nis');
            $dataInsert = [];
            foreach ($studentsId as $id) {
                array_push($dataInsert,[
                    'nis'=>$id,
                    'exam_account_num'=>$id.$request->exam_id,
                    'gerated_password'=>substr( str_shuffle( $chars ), 0, 6 ),
                    'exam_id'=>$request->exam_id,
                ]);
            }
            return DB::table('exam_student_participant')->insert($dataInsert);
                break;
            case 'SMP':
            $studentsId = $this->kelasRepo->getStudentsSMPFromArrayClass(json_decode($request->classes,true))->pluck('nis');
            $dataInsert = [];
            foreach ($studentsId as $id) {
                array_push($dataInsert,[
                    'nis'=>$id,
                    'exam_account_num'=>$id.$request->exam_id,
                    'gerated_password'=>substr( str_shuffle( $chars ), 0, 6 ),
                    'exam_id'=>$request->exam_id
                ]);
            }
            return DB::table('exam_student_participant')->insert($dataInsert);
                break;
            case 'SMA':
            $studentsId = $this->kelasRepo->getStudentsSMAFromArrayClass(json_decode($request->classes,true))->pluck('nis');
            $dataInsert = [];
            foreach ($studentsId as $id) {
                array_push($dataInsert,[
                    'nis'=>$id,
                    'exam_account_num'=>$id.$request->exam_id,
                    'gerated_password'=>substr( str_shuffle( $chars ), 0, 6 ),
                    'exam_id'=>$request->exam_id
                ]);
            }
            return DB::table('exam_student_participant')->insert($dataInsert);
                break;
            default:
                break;
        }
    }



}
