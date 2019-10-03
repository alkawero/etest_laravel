<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRancangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rancangans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('creator',11);
            $table->string('jenjang',5);
            $table->string('grade_char',3);
            $table->tinyInteger('grade_num');
            $table->string('tahun_ajaran_char',9);
            $table->tinyInteger('soal_quota');
            $table->char('quota_composition',1);
            $table->tinyInteger('mc_composition');
            $table->tinyInteger('es_composition'); 
            $table->char('collaboration_type',1); 
            $table->string('partner',11);
            $table->tinyInteger('partner_quota');
            $table->boolean('status');
            $table->dateTime('checked_date');
            $table->dateTime('approved_date');
            $table->dateTime('revision_duedate');
            $table->dateTime('proposed_date');
            $table->tinyInteger('exam_type_code');
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
        Schema::dropIfExists('rancangans');
    }
}
