<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang_Dosen extends Model
{
    protected $table = 'bidang_dosen';
    protected $filable = ['nama_bidang','prodi'];
}
