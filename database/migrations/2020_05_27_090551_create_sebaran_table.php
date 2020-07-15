<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSebaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sebaran', function (Blueprint $table) {
            $table->id();
            $table->string('kd_kelas');
            $table->string('kelas');
            $table->string('prodi');
            $table->integer('semester');
            $table->integer('mhs');
            $table->string('mata_kuliah');
            $table->integer('sks');
            $table->integer('jam');
            $table->string('dosen_mengajar');
            $table->integer('approved')->default(0);
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
        Schema::dropIfExists('sebaran');
    }
}
