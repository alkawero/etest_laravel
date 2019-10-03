<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('external');
            $table->string('create_by',11);
            $table->string('update_by',11);
            $table->dateTime('last_update');
            $table->tinyInteger('active');
            $table->tinyInteger('answer_type');
            $table->tinyInteger('content_type');
            $table->tinyInteger('question_type');
            $table->tinyInteger('status');
            $table->text('content');
            $table->text('question');
            $table->char('right_answer', 1);
            $table->string('verify_by',11);
            $table->string('media_url',150);
            $table->tinyInteger('level');
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
        Schema::dropIfExists('soals');
    }
}
