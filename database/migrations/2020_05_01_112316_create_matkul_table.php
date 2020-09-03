<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatkulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matkul', function (Blueprint $table) {
            $table->id();
            $table->string('kode_matkul','20');
            $table->string('matkul','30');
            $table->integer('sks');
            $table->integer('teori');
            $table->integer('praktek');
            $table->integer('jam_minggu');
            $table->string('kurikulum','10');
            $table->string('semester','10');
            $table->string('prodi','20');
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
        Schema::dropIfExists('matkul');
    }
}
