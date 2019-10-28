<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamStudentParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_student_participant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('nis',10);
            $table->String('exam_account_num',10);
            $table->String('gerated_password',6);
            $table->integer('exam_id');
            $table->string('jenjang',5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_student_participant');
    }
}
