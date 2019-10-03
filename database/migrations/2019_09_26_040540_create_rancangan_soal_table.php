<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRancanganSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rancangan_soal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('soal_id');
            $table->integer('rancangan_id');
            $table->integer('bobot');
            $table->string('add_by',11);
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
        Schema::dropIfExists('rancangan_soal');
    }
}
