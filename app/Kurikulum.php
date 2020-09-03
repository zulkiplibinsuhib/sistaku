<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';
    protected $filable = ['nama','prodi'];

    public function kurikulum()
    {
        return $this->belongsToMany(Kurikulum::class);
    }

}
