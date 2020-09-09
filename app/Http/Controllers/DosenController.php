<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\DosenExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $data['dosen'] = DB::table('dosen');
        $cari_bidang = DB::table('dosen')->groupBy('bidang')->get();
          
        $id = Auth::user()->prodi;
        $get_prodiAndDosen = 
                            DB::table('dosen')
                            ->join('prodi', 'dosen.prodi', '=', 'prodi.id')
                            ->select('dosen.name','dosen.nidn','dosen.jenis_kelamin','dosen.status','prodi.nama','dosen.id','dosen.bidang')
                            ->groupBy('name');
                            
       
        
        
        if(!empty($id)){
        $get_prodiAndDosen = $get_prodiAndDosen->where('dosen.prodi',$id);
        
        }
        
        
        if(!empty($_GET)){ 
            if(!empty($_GET['prodi'])){
                $prodi = $_GET['prodi'];
                $get_prodiAndDosen->where('prodi.id',$prodi);
              } 
            }
            if(!empty($_GET)){ 
                if(!empty($_GET['bidang'])){
                    $bidang = $_GET['bidang'];
                    $get_prodiAndDosen->where('dosen.bidang',$bidang);
                  } 
                }
                
        $get_prodiAndDosen = $get_prodiAndDosen->get();
        
     
        
            $data['get_prodiAndDosen'] = $get_prodiAndDosen;
            $data['cari_bidang'] = $cari_bidang;
            
           
        return view('dosen.index',$data);
    }
    public function export_excel()
	{
		return Excel::download(new DosenExport, 'dosen.xlsx');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_dosen = DB::table('dosen')->pluck('name');
        $data['data_dosen'] = $data_dosen;
        return view('dosen.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nidn' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'bidang' => 'required',
            
            
        ]);
        $all_prodi = $request->prodi;
        if($all_prodi == 'all'){
            $all = DB::table('prodi')->get();
            foreach ($all as $prodi){
                DB::table('dosen')->insert(['name'=>$request->name,
                'nidn'=>$request->nidn,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'status'=>$request->status,
                'bidang'=>$request->bidang,
                'prodi'=>$prodi->id ?? $request->user()->prodi ]);     
            }
        }else{
            DB::table('dosen')->insert(['name'=>$request->name,
            'nidn'=>$request->nidn,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'status'=>$request->status,
            'bidang'=>$request->bidang,
            'prodi'=>$request->prodi ?? $request->user()->prodi ]);   
        }
        
        return redirect('dosen/create')->with('status', 'Data added successfully, please add new data .');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cari_tahun = DB::table('sebaran')->groupBy('tahun_akademik')->get();
       
        $dosen = Dosen::find($id); 
        
        $jumlah_sks =DB::table('sebaran')
                    ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                    ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                    ->select('dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                    ->where('dosen_mengajar',$dosen->nidn);
        $jumlah_jam = DB::table('sebaran')
                    ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                    ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                    ->select('dosen.name','dosen.nidn','dosen.bidang','matkul.jam_minggu','matkul.sks','matkul.teori','matkul.praktek','matkul.kurikulum','matkul.semester')
                    ->where('dosen_mengajar',$dosen->nidn);
        $get_data = DB::table('sebaran')
                        ->join('prodi', 'prodi.id','=','sebaran.prodi')
                        ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                        ->join('kelas','sebaran.kd_kelas','=','kelas.id')
                        ->select('prodi.nama','sebaran.mata_kuliah','matkul.sks','matkul.jam_minggu as jam','matkul.matkul','kelas.kode as kode_kelas')
                        ->where('dosen_mengajar',$dosen->nidn);
        if(!empty($_GET)){
            if(!empty($_GET['tahun'])){
                $tahun = $_GET['tahun'];
                $get_data->where('sebaran.tahun_akademik',$tahun);
                $jumlah_jam->where('sebaran.tahun_akademik',$tahun);
                $jumlah_sks->where('sebaran.tahun_akademik',$tahun);
                } 
           
        }
        
       
       
        $data['dosen'] = $dosen ;
        $data['jumlah_sks'] = $jumlah_sks->sum('sks') ;
        $data['jumlah_jam'] = $jumlah_jam->sum('jam_minggu') ;
        $data['get_data'] = $get_data ->get() ;
        $data['cari_tahun'] = $cari_tahun ;
        
        return view('dosen.show',$data);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['dosen'] = DB::table('dosen')->where('id',$id)->first();
        return view('dosen.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nidn' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'bidang' => 'required',
            'prodi' => 'required',
            
        ]);
        DB::table('dosen')->where('id',$id)->update(['name'=>$request->name,
                                                    'nidn'=>$request->nidn,
                                                    'jenis_kelamin'=>$request->jenis_kelamin,
                                                    'status'=>$request->status,
                                                    'prodi'=>$request->prodi,
                                                    'bidang'=>$request->bidang,]);
                                                    return redirect('dosen')->with('status', 'Data updated successfully  .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('dosen')->where('id',$id)->delete();
        return redirect('dosen')->with('status', 'Data deleted successfully .');
    }
}
