<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $filable = ['kode','kelas','prodi','semester','mhs','keterangan'];
}
