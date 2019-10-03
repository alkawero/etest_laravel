<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('ujian_type');
            $table->string('jenjang',5);
            $table->string('grade_char',3);
            $table->tinyInteger('grade_num');
            $table->integer('subject');
            $table->integer('kelas_id')->nullable();
            $table->string('tahun_ajaran_char',9);
            $table->integer('id_ruangan')->nullable();
            $table->date('schedule_date');
            $table->dateTime('start_time'); 
            $table->dateTime('end_time'); 
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
        Schema::dropIfExists('schedules');
    }
}
