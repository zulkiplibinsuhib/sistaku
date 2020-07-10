<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $filable = ['kode_matkul','matkul','sks','id_prodi'];

    public function prodi()
    {
        return $this->belongsToMany(Matkul::class)->withPivot(['nama']);
    }

}
