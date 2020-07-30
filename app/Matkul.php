<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $filable = ['kode_matkul','matkul','sks','teori','praktek','jam_minggu','prodi','semester'];

    public function prodi()
    {
        return $this->belongsTo('App\Prodi', 'id', 'prodi');
    }
    
    }


