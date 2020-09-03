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
            $table->string('kd_kelas','10');
            $table->string('prodi','20');
            $table->string('tahun_akademik','20');
            $table->string('mata_kuliah','30');
            $table->integer('semester');
            $table->string('dosen_mengajar','30');
            $table->string('dosen_pdpt','30');
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
