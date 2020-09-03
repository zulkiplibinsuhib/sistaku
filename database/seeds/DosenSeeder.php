<?php

use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosen')->insert([
        'name' => 'Belum Memilih Dosen',
        'nidn' => '111',
        'jenis_kelamin' => '',
        'status' =>'admin',
        'bidang' => '0',
        'prodi' => '0',
        ]);
    }
}

