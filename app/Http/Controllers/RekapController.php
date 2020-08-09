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
        $cari_tahun = DB::table('matkul')->groupBy('tahun')->get();
        $get_prodiAndDosen = 
                            DB::table('dosen')
                            ->join('prodi', 'dosen.prodi', '=', 'prodi.id')
                            ->join('matkul', 'matkul.prodi', '=', 'prodi.id')
                            ->select('matkul.tahun','dosen.name','dosen.nidn','dosen.jenis_kelamin','dosen.status','prodi.nama','dosen.id','dosen.bidang')
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
            $dosen->jumlah_jam = DB::table('sebaran')->where('dosen_mengajar',$dosen->nidn)->sum('jam');
            $dosen->tahun_ajaran = DB::table('sebaran')->where('dosen_mengajar',$dosen->nidn)->select('tahun')->groupBy('tahun')->get();
            $dosen->jumlah_sks = DB::table('sebaran')->where('dosen_mengajar',$dosen->nidn)->sum('sks');
            $dosen->matkul_diambil = DB::table('sebaran')
                                    ->join('prodi','prodi.id','=','sebaran.prodi')
                                    ->where('dosen_mengajar',$dosen->nidn)
                                    ->select('sebaran.mata_kuliah','sebaran.prodi','prodi.nama')->get();
            $dosen->prodi_diambil = DB::table('sebaran')->where('dosen_mengajar',$dosen->nidn)->select('prodi')->get();
            $dosen->no = 1 ; 
        }
        $data['get_prodiAndDosen'] = $get_prodiAndDosen;
        $data['cari_dosen'] = $cari_dosen;
        $data['cari_tahun'] = $cari_tahun;
    
        return view('rekap.index',$data);
    }
}
