<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamKelasParticipant;
use App\Models\ExamStudentParticipant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class ResultRepository
{

    protected $exam;
    protected $examStudentParticipant;
    protected $examAnswer;

    public function __construct(Exam $exam, ExamStudentParticipant $examStudentParticipant, ExamAnswer $examAnswer)
    {
        $this->exam = $exam;
        $this->examAnswer = $examAnswer;
        $this->examStudentParticipant = $examStudentParticipant;
    }


    public function getResultOfKelas($exam_id, $nisArray)
    {
        $arrResult = [];
        $rancangan = $this->exam->find($exam_id)->rancangan()->first();
        $soals = $rancangan->soals()->select('soals.id', 'right_answer')->get();

        foreach ($nisArray as $nis) {
            $countRightAnswer = 0;

            $answers = $this->examAnswer
                ->select('soal_id', 'answer_code')
                ->where('exam_id', $exam_id)
                ->where('user_id', $nis->nis)
                ->get();

            foreach ($answers as $ans) {
                foreach ($soals as $soal) {
                    if ($soal->id === $ans->soal_id && $soal->right_answer === $ans->answer_code)
                        $countRightAnswer++;
                }
            }

            array_push($arrResult, ["nis" => $nis->nis, "nama" => $nis->nama, "right_answer_count" => $countRightAnswer]);

        }
        return $arrResult;
    }

    public function getResultOfNis($nis, $exam_id)
    {
        $examAccount = $this->examStudentParticipant
            ->where('nis', $nis)
            ->where('exam_id', $exam_id)->first();

        $countRightAnswer = 0;
        $rancangan = $this->exam->find($exam_id)->rancangan()->first();
        $soals = $rancangan->soals()->select('soals.id', 'right_answer')->get();
        $answers = $this->examAnswer
            ->select('soal_id', 'answer_code')
            ->where('exam_id', $exam_id)
            ->where('user_id', $nis)
            ->get();

        if (count($answers) > 0) {
            foreach ($answers as $ans) {
                foreach ($soals as $soal) {
                    if ($soal->id === $ans->soal_id && $soal->right_answer === $ans->answer_code)
                        $countRightAnswer++;
                }
            }

            return [
                "soal_count" => count($soals),
                "right_answer_count" => $countRightAnswer,
                "wrong_answer_count" => count($soals) - $countRightAnswer
            ];
        } else {
            return null;
        }
    }
}
