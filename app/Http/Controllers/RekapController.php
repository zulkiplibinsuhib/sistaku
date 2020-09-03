<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\DosenExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Dosen;

class RekapController extends Controller
{
    public function index() 
    {
        

        $data['dosen'] = DB::table('dosen');
        $id = Auth::user()->prodi;
        $cari_dosen = DB::table('dosen')->groupBy('name')->get();
        $cari_tahun = DB::table('sebaran')->get();
        $get_prodiAndDosen = 
                            DB::table('dosen')
                            ->join('prodi', 'dosen.prodi', '=', 'prodi.id')
                            ->join('matkul', 'matkul.prodi', '=', 'prodi.id')
                            ->select('dosen.name','dosen.nidn','dosen.jenis_kelamin','dosen.status','prodi.nama','dosen.id','dosen.bidang')
                            ->groupBy('name');
        if(!empty($id)){
        $get_prodiAndDosen = $get_prodiAndDosen->where('dosen.prodi',$id);
        }
        
        // cari prodi
        if(!empty($_GET)){ 
            if(!empty($_GET['prodi'])){
                $prodi = $_GET['prodi'];
                $get_prodiAndDosen->where('prodi.id',$prodi);
              } 
            }
        if(!empty($_GET)){ 
            if(!empty($_GET['dosen'])){
                $dosen = $_GET['dosen'];
                $get_prodiAndDosen->where('dosen.nidn',$dosen);
                } 
            }
               
            
        $get_prodiAndDosen = $get_prodiAndDosen->get();
        foreach($get_prodiAndDosen as &$dosen)
        {
            $dosen->jumlah_jam = DB::table('sebaran')
                                ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                ->select('dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                                ->where('dosen_mengajar',$dosen->nidn)->sum('jam_minggu');
            $dosen->tahun_akademik = DB::table('sebaran')->where('dosen_mengajar',$dosen->nidn)->select('tahun_akademik')->groupBy('tahun_akademik')->get();
            $dosen->jumlah_sks = DB::table('sebaran')
                                ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                ->select('dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                                ->where('dosen_mengajar',$dosen->nidn)->sum('sks');
            $dosen->matkul_diambil = DB::table('sebaran')
                                    ->join('prodi','prodi.id','=','sebaran.prodi')
                                    ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                                    ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                                    ->select('sebaran.prodi','prodi.nama','matkul.matkul','sebaran.dosen_mengajar')->get()
                                    ->where('dosen_mengajar',$dosen->nidn);
            $dosen->prodi_diambil = DB::table('sebaran')->where('dosen_mengajar',$dosen->nidn)->select('prodi')->get();
            
            
            $dosen->no = 1 ; 
            
        }
      
        $data['get_prodiAndDosen'] = $get_prodiAndDosen;
        $data['cari_dosen'] = $cari_dosen;
        $data['cari_tahun'] = $cari_tahun;
    
        return view('rekap.index',$data);
    }
}
