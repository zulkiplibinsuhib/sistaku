<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sebaran extends Model
{
    protected $table = "sebaran";
 
    protected $fillable = ['kd_kelas','kelas','prodi','semester','mhs','mata_kuliah','sks','jam','dosen_mengajar','approved'];
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }
}