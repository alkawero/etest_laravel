<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $table='exam_answer';
    protected $fillable = ['exam_id','rancangan_id','soal_id','user_id','answer_code','answer_text'];
}
