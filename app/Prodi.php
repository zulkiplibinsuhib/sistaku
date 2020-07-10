<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $filable = ['kode','nama'];

    public function matkul()
    {
        return $this->belongsToMany(Matkul::class);
    }

}
