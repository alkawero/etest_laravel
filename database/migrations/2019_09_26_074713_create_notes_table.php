<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('note_type_code');
            $table->text('text');
            $table->text('tittle');
            $table->string('from',11);
            $table->string('to_person',11)->nullable();
            $table->tinyInteger('to_role')->nullable();
            $table->boolean('represent_role')->nullable();
            $table->integer('object_id');
            $table->boolean('status');
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
        Schema::dropIfExists('notes');
    }
}
