<?php

namespace App\Exports;

use App\Sebaran;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use DB;
use Illuminate\Support\Facades\Auth;



class SebaranProdiExport implements FromView
{
    public function view(): View
    {
       
        $year = date('Y');
        $year1 = $year++ ;
       
        $no = 1;
        $id =  Auth::user()->prodi;
        $sebaran =  DB::table('sebaran')
                             ->leftJoin('prodi','sebaran.prodi', '=', 'prodi.id')
                             ->leftJoin('kelas','sebaran.kd_kelas','=','kelas.id')
                             ->leftJoin('matkul','sebaran.mata_kuliah','=','matkul.id')
                             ->leftJoin('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                             ->leftJoin('table_dosen','sebaran.dosen_pdpt','=','table_dosen.nidn')
                             ->select('table_dosen.id','table_dosen.name as dosen_pdpt','dosen.nidn','dosen.id','dosen.name','sebaran.id as id_sebaran','kelas.id','kelas.kode','kelas.keterangan','prodi.kode as kode_prodi','sebaran.tahun_akademik','matkul.semester','kelas.mhs','matkul.matkul','matkul.sks',
                             'matkul.teori','matkul.kode_matkul','matkul.praktek','matkul.jam_minggu','sebaran.dosen_mengajar','sebaran.approved','prodi.id')->orderBy('semester');
        if($id){$sebaran = $sebaran->where('sebaran.prodi',$id);} 
        $data['sebaran'] = $sebaran->get();
        $data['no'] = $no;
        $data['year'] = $year;
        $data['year1'] = $year1;
        return view('exports.sebaran',$data);
    }
}
