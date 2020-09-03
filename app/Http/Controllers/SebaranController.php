<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Kelas;
use App\Matkul;
use App\Sebaran;
use App\Dosen;
use App\Prodi;
use PDF;

use Illuminate\Support\Facades\Auth;

class SebaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id =  Auth::user()->prodi;
        $data['sebaran'] = DB::table('sebaran')->get();
        $cari_semester = DB::table('sebaran')->orderBy('semester')->groupBy('semester')->get();
        $cari_tahun = DB::table('sebaran')->orderBy('tahun_akademik')->groupBy('tahun_akademik')->get();
        $sebaran = DB::table('sebaran')
                             ->join('prodi','sebaran.prodi', '=', 'prodi.id')
                             ->join('kelas','sebaran.kd_kelas','=','kelas.id')
                             ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                             ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                             ->join('table_dosen','sebaran.dosen_pdpt','=','table_dosen.nidn')
                             ->select('table_dosen.id','table_dosen.name as dosen_pdpt','dosen.nidn','dosen.id','dosen.name','sebaran.id as id_sebaran','kelas.id','kelas.kode','kelas.kelas','prodi.nama as nama_prodi','sebaran.tahun_akademik','matkul.semester','kelas.mhs','matkul.matkul','matkul.sks',
                             'matkul.teori','matkul.praktek','matkul.jam_minggu','sebaran.dosen_mengajar','sebaran.approved','prodi.id')->orderBy('semester');
                            
        if($id){
        $sebaran = $sebaran->where('sebaran.prodi',$id);
       } 
       
       if(!empty($_GET)){
          if(!empty($_GET['prodi'])){
            $prodi = $_GET['prodi'];
            $sebaran->where('prodi.id',$prodi);
          } 
          if(!empty($_GET['semester'])){
            $semester = $_GET['semester'];
            $sebaran->where('sebaran.semester',$semester);
          } 
          if(!empty($_GET['tahun'])){
            $tahun = $_GET['tahun'];
            $sebaran->where('sebaran.tahun_akademik',$tahun);
          } 
    }
        $data['sebaran'] = $sebaran->get();    
       
        $data['cari_semester'] = $cari_semester;  
        $data['cari_tahun'] = $cari_tahun;  
        return view('sebaran.index',$data);
    }   
    
    public function kurikulum_2019_ganjil(Request $request)
    {
        $id =  Auth::user()->prodi;
        $year = date('Y');
        $semester1 = $request->semester1;
        $semester3 = $request->semester3;
        $semester5 = $request->semester5;
        $semester7 = $request->semester7;
        $data_semester1 = DB::table('matkul')->where('kurikulum',2019)->where('semester',$semester1)->orderBy('matkul');
        $data_semester3 = DB::table('matkul')->where('kurikulum',2019)->where('semester',$semester3)->orderBy('matkul');
        $data_semester5 = DB::table('matkul')->where('kurikulum',2019)->where('semester',$semester5)->orderBy('matkul');
        $data_semester7 = DB::table('matkul')->where('kurikulum',2019)->where('semester',$semester7)->orderBy('matkul');

        if($id){
            $data_semester1 = $data_semester1->where('prodi',$id)->get();
            $data_semester3 = $data_semester3->where('prodi',$id)->get();
            $data_semester5 = $data_semester5->where('prodi',$id)->get();
            $data_semester7 = $data_semester7->where('prodi',$id)->get();
          }
          $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
          $data_kelas = DB::table('kelas')->where('prodi',Auth::user()->prodi)->pluck('kelas');
         
          return response()->json(['data'=>$data_semester1,$data_dosen,$data_kelas,$data_semester3,$data_semester5,$data_semester7,$year]);
    }

    public function ajax_create(Request $request)
    {
        $id =  Auth::user()->prodi;
        $kurikulum = $request->kurikulum;
        $semester = $request->semester;
        if($semester == 'ganjil'){
            $semester = [1,3,5,7];
        }else{
            $semester = [2,4,6,8];
        }
        $get_data = DB::table('matkul')
                            ->join ('kelas', 'matkul.semester', '=', 'kelas.semester')
                            ->select('matkul.jam_minggu','matkul.teori','matkul.praktek','matkul.kode_matkul'
                            ,'matkul.matkul','matkul.sks','matkul.semester'
                            ,'matkul.kurikulum as kurikulum','kelas.semester as semester'
                            ,'kelas.kode as kode','kelas.mhs','kelas.kelas','kelas.prodi','kelas.tahun')
                            ->whereIn('matkul.semester',$semester);
      
      if($id){
        $get_data = $get_data->where('kelas.prodi',$id)->where('matkul.prodi',$id)->get();
      }
      $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
      return response()->json(['data'=>$get_data,$data_dosen]);
        }
      public function ajax_select(Request $request)
      {
        $ganjil = DB::table('matkul')->where('semester',1);
        $genap = DB::table('matkul')->where('semester',2,4,6,8);
        $data['ganjil'] = $ganjil;
        $data['genap'] = $genap;

       $kurikulum = $request->kurikulum;
       $get_data = DB::table('matkul')->where('kurikulum',$kurikulum)->groupBy('semester')->get();
           
           return response()->json(['data'=>$get_data]);
        }
        public function pilih_kelas(Request $request){
            $get = $request->get;
            $kelas= Kelas::where('id','=',$get)->first();
            if(isset($kelas)){
                $data = array(
                    
                    'kode' => $kelas['kode'],
                    
                ); 
            return response()->json($data);
          
      }
    }

    public function approve(Request $request, $id)
    {
        $sebaran = DB::table('sebaran')->where('id',$id)->update(['approved'=>1]);
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semester1 = DB::table('matkul')->where('semester',1)->get();
        $semester2 = DB::table('matkul')->where('semester',2)->get();
        $semester3 = DB::table('matkul')->where('semester',3)->get();
        $semester4 = DB::table('matkul')->where('semester',4)->get();
        $semester5 = DB::table('matkul')->where('semester',5)->get();
        $semester6 = DB::table('matkul')->where('semester',6)->get();
        $semester7 = DB::table('matkul')->where('semester',7)->get();
        $semester8 = DB::table('matkul')->where('semester',8)->get();
        $data['semester1'] = $semester1;
        $data['semester2'] = $semester2;
        $data['semester3'] = $semester3;
        $data['semester4'] = $semester4;
        $data['semester5'] = $semester5;
        $data['semester6'] = $semester6;
        $data['semester7'] = $semester7;
        $data['semester8'] = $semester8;
        $matkul_kur2019 = DB::table('matkul')->where('kurikulum',2019)->get();
        $ganjil = DB::table('matkul')->where('semester',1,3,5,7);
        $genap = DB::table('matkul')->where('semester',2,4,6,8);
        $data['ganjil'] = $ganjil;
        $data['genap'] = $genap;
        $kurikulum = DB::table('kurikulum')->groupBy('nama')->get();
        $data['get_data'] = Dosen::all();
        $data['sebaran'] = DB::table('sebaran')->get();
        $data_prodi = DB::table('prodi')->pluck('nama');
        $data_kode = DB::table('kelas')->where('prodi',Auth::user()->prodi)->get();
        $data_kelas = DB::table('kelas')->pluck('kelas');
        $data_matkul = DB::table('matkul')->where('prodi',Auth::user()->prodi)->get();
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['kurikulum'] = $kurikulum;
        $data['data_prodi'] = $data_prodi;
        $data['data_kode'] = $data_kode;
        $data['data_kelas'] = $data_kelas;
        $data['data_matkul'] = $data_matkul;
        $data['data_dosen'] = $data_dosen;
        $data['matkul_kur2019'] = $matkul_kur2019;
        return view('sebaran.create',$data);
    }
    public function create_kur2019_ganjil(){
        $year =  date('Y')   ;
        $year1 = $year++ ;
        $semester1 = DB::table('matkul')->where('semester',1)->where('kurikulum',2019)->get();
        $semester3 = DB::table('matkul')->where('semester',3)->where('kurikulum',2019)->get();
        $semester5 = DB::table('matkul')->where('semester',5)->where('kurikulum',2019)->get();
        $semester7 = DB::table('matkul')->where('semester',7)->where('kurikulum',2019)->get();
        $data_kelas = DB::table('kelas')->where('prodi',Auth::user()->prodi)->get();

        $data['semester1'] = $semester1;
        $data['semester3'] = $semester3;
        $data['semester5'] = $semester5;
        $data['semester7'] = $semester7;
        $data['data_kelas'] = $data_kelas;
        $data['year'] = $year;
        $data['year1'] = $year1;
        
        
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['data_dosen'] = $data_dosen;
        return view('sebaran.kur2019_ganjil',$data);
    }
    public function create_kur2019_genap(){
        $semester2 = DB::table('matkul')->where('semester',2)->where('kurikulum',2019)->get();
        $semester4 = DB::table('matkul')->where('semester',4)->where('kurikulum',2019)->get();
        $semester6 = DB::table('matkul')->where('semester',6)->where('kurikulum',2019)->get();
        $semester8 = DB::table('matkul')->where('semester',8)->where('kurikulum',2019)->get();
        $data['semester2'] = $semester2;
        $data['semester4'] = $semester4;
        $data['semester6'] = $semester6;
        $data['semester8'] = $semester8;
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['data_dosen'] = $data_dosen;
        return view('sebaran.kur2019_genap',$data);
    }
    public function create_kur2014_ganjil(){
        $semester1 = DB::table('matkul')->where('semester',1)->where('kurikulum',2014)->get();
        $semester3 = DB::table('matkul')->where('semester',3)->where('kurikulum',2014)->get();
        $semester5 = DB::table('matkul')->where('semester',5)->where('kurikulum',2014)->get();
        $semester7 = DB::table('matkul')->where('semester',7)->where('kurikulum',2014)->get();
        $data['semester1'] = $semester1;
        $data['semester3'] = $semester3;
        $data['semester5'] = $semester5;
        $data['semester7'] = $semester7;
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['data_dosen'] = $data_dosen;

        return view('sebaran.kur2014_ganjil',$data);
    }
    public function create_kur2014_genap(){
        $semester2 = DB::table('matkul')->where('semester',2)->where('kurikulum',2014)->get();
        $semester4 = DB::table('matkul')->where('semester',4)->where('kurikulum',2014)->get();
        $semester6 = DB::table('matkul')->where('semester',6)->where('kurikulum',2014)->get();
        $semester8 = DB::table('matkul')->where('semester',8)->where('kurikulum',2014)->get();
        $data['semester2'] = $semester2;
        $data['semester4'] = $semester4;
        $data['semester6'] = $semester6;
        $data['semester8'] = $semester8;
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['data_dosen'] = $data_dosen;
        return view('sebaran.kur2014_genap',$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $get = DB::table('sebaran')->where('tahun',$request->tahun[0])->where('semester',$request->semester[0])->where('prodi',Auth::user()->prodi) ->first();
        // if(!empty($get)){
        //     return redirect()->back()->withErrors(["Warning !!! <br> Data Sebaran Semester {$request->semester[0]} Tahun {$request->tahun[0]} telah diisi sebelumnya .<br> Silahkan isi Data sebaran yang lain :)"]);
        // }
        $validatedData = $request->validate([
            'kd_kelas' => 'required',
            'semester' => 'required',
            'tahun_akademik' => 'required',
            'mata_kuliah' =>'required',
            'dosen_pdpt' => 'required',
            'dosen_mengajar' => 'required'
        ]);
            
        for($x=0;$x<count($request->kd_kelas);$x++){
            DB::table('sebaran')->insert(['kd_kelas'=>$request->kd_kelas[$x],
            'prodi'=>$request->prodi[$x] ?? $request->user()->prodi,
            'semester'=>$request->semester[$x],
            'mata_kuliah'=>$request->mata_kuliah[$x],
            'tahun_akademik'=>$request->tahun_akademik[$x],
            'dosen_pdpt'=>$request->dosen_pdpt[$x],
            'dosen_mengajar'=>$request->dosen_mengajar[$x]
            ]);
        }
        return redirect('sebaran')->with('status', 'Data added successfully, please add new data .');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function sebaran_pdf()
    {
        return view('sebaran.cetak_pdf');
    }
    public function cetak_pdf()
    {
    	$sebaran = Sebaran::all();
        $pdf->set_paper('landscape');
        $pdf = PDF::loadview('sebaran/cetak_pdf',['sebaran'=>$sebaran]);
        
    	return $pdf->download('laporan-sebaran-pdf');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sebaran = DB::table('sebaran')
                    ->join('matkul','sebaran.mata_kuliah','=','matkul.id')
                    ->join('kelas','sebaran.kd_kelas','=','kelas.id')
                    ->select('sebaran.id','sebaran.mata_kuliah as id_matkul','sebaran.kd_kelas as id_kelas','kelas.kode','matkul.kode_matkul','sebaran.prodi','sebaran.semester','sebaran.tahun_akademik')->first();
                    
        $data['sebaran'] = $sebaran ;
        
        $data_dosen = DB::table('dosen')
                        ->where('dosen.prodi',$data['sebaran']->prodi)
                        ->get();

        $data['data_dosen'] = $data_dosen;
        $data_prodi = DB::table('prodi')->pluck('nama');
        $data['data_prodi'] = $data_prodi;
        return view('sebaran.edit',$data);
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
            'kd_kelas' => 'required',
            'mata_kuliah' => 'required',
            'dosen_mengajar' => 'required',
            'dosen_pdpt' => 'required',
         
        ]);
        DB::table('sebaran')->where('id',$id)->update(['kd_kelas'=>$request->kd_kelas,
                                                        'prodi'=>$request->prodi,
                                                        'mata_kuliah'=>$request->mata_kuliah,
                                                        'tahun_akademik'=>$request->tahun_akademik,
                                                        'dosen_pdpt'=>$request->dosen_pdpt,
                                                        'semester'=>$request->semester,
                                                        'dosen_mengajar'=>$request->dosen_mengajar]);
                                                        return redirect('sebaran')->with('status', 'Data updated successfully  .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('sebaran')->where('id',$id)->delete();
        return redirect('sebaran')->with('status', 'Data deleted successfully .');
    }
}
