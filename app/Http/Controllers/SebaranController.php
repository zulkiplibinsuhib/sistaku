<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Kelas;
use App\Matkul;
use App\Sebaran;
use App\Dosen;
use App\Prodi;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SebaranExport;
use App\Exports\SebaranProdiExport;
use Illuminate\Support\Facades\Auth;
use PDO;

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
        $pilih_tahun = DB::table('sebaran')->orderBy('tahun_akademik')->groupBy('tahun_akademik')->get();
        $data['pilih_prodi'] = DB::table('sebaran')
                                ->join('prodi','sebaran.prodi','=','prodi.id')
                                ->select('prodi.id','prodi.nama')
                                ->orderBy('prodi.id')->groupBy('prodi.id')->get();
        $sebaran = DB::table('sebaran')
                             ->leftJoin('prodi','sebaran.prodi', '=', 'prodi.id')
                             ->leftJoin('kelas','sebaran.kd_kelas','=','kelas.id')
                             ->leftJoin('matkul','sebaran.mata_kuliah','=','matkul.id')
                             ->leftJoin('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                             ->leftJoin('table_dosen','sebaran.dosen_pdpt','=','table_dosen.nidn')
                             ->select('table_dosen.id','table_dosen.name as dosen_pdpt','dosen.nidn','dosen.id','dosen.name','sebaran.id as id_sebaran','kelas.id','kelas.kode','kelas.kelas','prodi.nama as nama_prodi','sebaran.tahun_akademik','matkul.semester','kelas.mhs','matkul.matkul','matkul.sks',
                             'matkul.teori','matkul.praktek','matkul.jam_minggu','sebaran.dosen_mengajar','sebaran.approved','prodi.id')->orderBy('semester');
                            
        if($id){$sebaran = $sebaran->where('sebaran.prodi',$id);} 

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
        $data['pilih_tahun'] = $pilih_tahun;  
        return view('sebaran.index',$data);
    }   
    
    public function kurikulum_2019_ganjil(Request $request)
    {
        $id =  Auth::user()->prodi;
        $data['pilih_kelas1'] = DB::table('kelas')->where('semester',1)->orderBy('tahun')->get();
        $data['pilih_kelas3'] = DB::table('kelas')->where('semester',3)->orderBy('tahun')->get();
        $data['pilih_kelas5'] = DB::table('kelas')->where('semester',5)->orderBy('tahun')->get();
        $data['pilih_kelas7'] = DB::table('kelas')->where('semester',7)->orderBy('tahun')->get();
        $year = date('Y');
        $year1 = $year++ ;
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
          
         
          return response()->json(['data'=>$data,$data_semester1,$data_dosen,$year1,$data_semester3,$data_semester5,$data_semester7,$year]);
    }
    public function kurikulum_2019_genap(Request $request)
    {
        $id =  Auth::user()->prodi;
        $data['pilih_kelas2'] = DB::table('kelas')->where('semester',2)->orderBy('tahun')->get();
        $data['pilih_kelas4'] = DB::table('kelas')->where('semester',4)->orderBy('tahun')->get();
        $data['pilih_kelas6'] = DB::table('kelas')->where('semester',6)->orderBy('tahun')->get();
        $data['pilih_kelas8'] = DB::table('kelas')->where('semester',8)->orderBy('tahun')->get();
        $year = date('Y');
        $year1 = $year++ ;
        $semester2 = $request->semester2;
        $semester4 = $request->semester4;
        $semester6 = $request->semester6;
        $semester8 = $request->semester8;
        $data_semester2 = DB::table('matkul')->where('kurikulum',2019)->where('semester',$semester2)->orderBy('matkul');
        $data_semester4 = DB::table('matkul')->where('kurikulum',2019)->where('semester',$semester4)->orderBy('matkul');
        $data_semester6 = DB::table('matkul')->where('kurikulum',2019)->where('semester',$semester6)->orderBy('matkul');
        $data_semester8 = DB::table('matkul')->where('kurikulum',2019)->where('semester',$semester8)->orderBy('matkul');

        if($id){
            $data_semester2 = $data_semester2->where('prodi',$id)->get();
            $data_semester4 = $data_semester4->where('prodi',$id)->get();
            $data_semester6 = $data_semester6->where('prodi',$id)->get();
            $data_semester8 = $data_semester8->where('prodi',$id)->get();
          }
          $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
          
         
          return response()->json(['data'=>$data,$data_semester2,$data_dosen,$year1,$data_semester4,$data_semester6,$data_semester8,$year]);
    }
    public function kurikulum_2014_ganjil(Request $request)
    {
        $id =  Auth::user()->prodi;
        $data['pilih_kelas1'] = DB::table('kelas')->where('semester',1)->orderBy('tahun')->get();
        $data['pilih_kelas3'] = DB::table('kelas')->where('semester',3)->orderBy('tahun')->get();
        $data['pilih_kelas5'] = DB::table('kelas')->where('semester',5)->orderBy('tahun')->get();
        $data['pilih_kelas7'] = DB::table('kelas')->where('semester',7)->orderBy('tahun')->get();
        $year = date('Y');
        $year1 = $year++ ;
        $semester1 = $request->semester1;
        $semester3 = $request->semester3;
        $semester5 = $request->semester5;
        $semester7 = $request->semester7;
        $data_semester1 = DB::table('matkul')->where('kurikulum',2014)->where('semester',$semester1)->orderBy('matkul');
        $data_semester3 = DB::table('matkul')->where('kurikulum',2014)->where('semester',$semester3)->orderBy('matkul');
        $data_semester5 = DB::table('matkul')->where('kurikulum',2014)->where('semester',$semester5)->orderBy('matkul');
        $data_semester7 = DB::table('matkul')->where('kurikulum',2014)->where('semester',$semester7)->orderBy('matkul');

        if($id){
            $data_semester1 = $data_semester1->where('prodi',$id)->get();
            $data_semester3 = $data_semester3->where('prodi',$id)->get();
            $data_semester5 = $data_semester5->where('prodi',$id)->get();
            $data_semester7 = $data_semester7->where('prodi',$id)->get();
          }
          $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
          
         
          return response()->json(['data'=>$data,$data_semester1,$data_dosen,$year1,$data_semester3,$data_semester5,$data_semester7,$year]);
    }
    public function kurikulum_2014_genap(Request $request)
    {
        $id =  Auth::user()->prodi;
        $data['pilih_kelas2'] = DB::table('kelas')->where('semester',2)->orderBy('tahun')->get();
        $data['pilih_kelas4'] = DB::table('kelas')->where('semester',4)->orderBy('tahun')->get();
        $data['pilih_kelas6'] = DB::table('kelas')->where('semester',6)->orderBy('tahun')->get();
        $data['pilih_kelas8'] = DB::table('kelas')->where('semester',8)->orderBy('tahun')->get();
        $year = date('Y');
        $year1 = $year++ ;
        $semester2 = $request->semester2;
        $semester4 = $request->semester4;
        $semester6 = $request->semester6;
        $semester8 = $request->semester8;
        $data_semester2 = DB::table('matkul')->where('kurikulum',2014)->where('semester',$semester2)->orderBy('matkul');
        $data_semester4 = DB::table('matkul')->where('kurikulum',2014)->where('semester',$semester4)->orderBy('matkul');
        $data_semester6 = DB::table('matkul')->where('kurikulum',2014)->where('semester',$semester6)->orderBy('matkul');
        $data_semester8 = DB::table('matkul')->where('kurikulum',2014)->where('semester',$semester8)->orderBy('matkul');

        if($id){
            $data_semester1 = $data_semester2->where('prodi',$id)->get();
            $data_semester3 = $data_semester4->where('prodi',$id)->get();
            $data_semester5 = $data_semester6->where('prodi',$id)->get();
            $data_semester7 = $data_semester8->where('prodi',$id)->get();
          }
          $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
          
         
          return response()->json(['data'=>$data,$data_semester2,$data_dosen,$year1,$data_semester4,$data_semester6,$data_semester8,$year]);
    }

    public function ajax_create(Request $request)
    {
        $year =  date('Y')   ;
        $year1 = $year++ ;
        $id =  Auth::user()->prodi;
        $kurikulum = $request->kurikulum;
        $semester = $request->semester;
       
        $get_data = DB::table('matkul')->where('semester',$semester)->where('kurikulum',$kurikulum);
      
      if($id){
        $get_data = $get_data->where('prodi',$id)->get();
      }
     
      $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
      
      return response()->json(['data'=>$get_data,$data_dosen,$year,$year1]);
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
                
                'kode' => $kelas['id'],
                
            ); 
        return response()->json($data);
          
      }
    }

    public function approve(Request $request, $id){
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
        $data['pilih_kelas'] = DB::table('kelas')->where('semester',1)->orderBy('tahun')->get();

        $year =  date('Y')   ;
        $year1 = $year++ ;
        $semester = DB::table('matkul')->where('prodi',Auth::user()->prodi)->groupBy('semester')->get();
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
        $data['year'] = $year;
        $data['year1'] = $year1;
        $matkul_kur2019 = DB::table('matkul')->where('kurikulum',2019)->get();
        $kurikulum = DB::table('kurikulum')->groupBy('nama')->get();
        $data['get_dosen'] = Dosen::all();
        $data_kelas = DB::table('kelas')->where('prodi',Auth::user()->prodi)->get();
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['kurikulum'] = $kurikulum;
        $data['data_kelas'] = $data_kelas;
        $data['data_dosen'] = $data_dosen;
        $data['matkul_kur2019'] = $matkul_kur2019;
        $data['semester'] = $semester;
        return view('sebaran.create',$data);
    }
    public function create_kur2019_ganjil(){
        $year =  date('Y')   ;
        $year1 = $year++ ;
        $data['pilih_kelas1'] = DB::table('kelas')->where('semester',1)->orderBy('tahun')->get();
        $data['pilih_kelas3'] = DB::table('kelas')->where('semester',3)->orderBy('tahun')->get();
        $data['pilih_kelas5'] = DB::table('kelas')->where('semester',5)->orderBy('tahun')->get();
        $data['pilih_kelas7'] = DB::table('kelas')->where('semester',7)->orderBy('tahun')->get();
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
        $year =  date('Y')   ;
        $year1 = $year++ ;
        $data['pilih_kelas2'] = DB::table('kelas')->where('semester',2)->orderBy('tahun')->get();
        $data['pilih_kelas4'] = DB::table('kelas')->where('semester',4)->orderBy('tahun')->get();
        $data['pilih_kelas6'] = DB::table('kelas')->where('semester',6)->orderBy('tahun')->get();
        $data['pilih_kelas8'] = DB::table('kelas')->where('semester',8)->orderBy('tahun')->get();
        $semester2 = DB::table('matkul')->where('semester',2)->where('kurikulum',2019)->get();
        $semester4 = DB::table('matkul')->where('semester',4)->where('kurikulum',2019)->get();
        $semester6 = DB::table('matkul')->where('semester',6)->where('kurikulum',2019)->get();
        $semester8 = DB::table('matkul')->where('semester',8)->where('kurikulum',2019)->get();
        $data_kelas = DB::table('kelas')->where('prodi',Auth::user()->prodi)->get();
        $data['semester2'] = $semester2;
        $data['semester4'] = $semester4;
        $data['semester6'] = $semester6;
        $data['semester8'] = $semester8;
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['data_dosen'] = $data_dosen;
        $data['year'] = $year;
        $data['year1'] = $year1;
        $data['data_kelas'] = $data_kelas;
        
        return view('sebaran.kur2019_genap',$data);
    }
    public function create_kur2014_ganjil(){
        $year =  date('Y')   ;
        $year1 = $year++ ;
        $data['pilih_kelas1'] = DB::table('kelas')->where('semester',1)->orderBy('tahun')->get();
        $data['pilih_kelas3'] = DB::table('kelas')->where('semester',3)->orderBy('tahun')->get();
        $data['pilih_kelas5'] = DB::table('kelas')->where('semester',5)->orderBy('tahun')->get();
        $data['pilih_kelas7'] = DB::table('kelas')->where('semester',7)->orderBy('tahun')->get();
        $semester1 = DB::table('matkul')->where('semester',1)->where('kurikulum',2014)->get();
        $semester3 = DB::table('matkul')->where('semester',3)->where('kurikulum',2014)->get();
        $semester5 = DB::table('matkul')->where('semester',5)->where('kurikulum',2014)->get();
        $semester7 = DB::table('matkul')->where('semester',7)->where('kurikulum',2014)->get();
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
        return view('sebaran.kur2014_ganjil',$data);
    }
    public function create_kur2014_genap(){
        $year =  date('Y')   ;
        $year1 = $year++ ;
        $data['pilih_kelas2'] = DB::table('kelas')->where('semester',2)->orderBy('tahun')->get();
        $data['pilih_kelas4'] = DB::table('kelas')->where('semester',4)->orderBy('tahun')->get();
        $data['pilih_kelas6'] = DB::table('kelas')->where('semester',6)->orderBy('tahun')->get();
        $data['pilih_kelas8'] = DB::table('kelas')->where('semester',8)->orderBy('tahun')->get();
        $semester2 = DB::table('matkul')->where('semester',2)->where('kurikulum',2014)->get();
        $semester4 = DB::table('matkul')->where('semester',4)->where('kurikulum',2014)->get();
        $semester6 = DB::table('matkul')->where('semester',6)->where('kurikulum',2014)->get();
        $semester8 = DB::table('matkul')->where('semester',8)->where('kurikulum',2014)->get();
        $data_kelas = DB::table('kelas')->where('prodi',Auth::user()->prodi)->get();
        $data['semester2'] = $semester2;
        $data['semester4'] = $semester4;
        $data['semester6'] = $semester6;
        $data['semester8'] = $semester8;
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['data_dosen'] = $data_dosen;
        $data['year'] = $year;
        $data['year1'] = $year1;
        $data['data_kelas'] = $data_kelas;
        
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
        $arr = [];
        for($x=0;$x<count($request->kd_kelas);$x++){
        $data = DB::table('sebaran')
        ->join('kelas','kelas.id','=','sebaran.kd_kelas')
        ->select('kelas.kode','sebaran.tahun_akademik','sebaran.semester')
        ->where('sebaran.semester',$request->semester[$x])->where('tahun_akademik',$request->tahun_akademik[$x])->where('kd_kelas',$request->kd_kelas[$x])->where('sebaran.prodi',$request->prodi[$x])->first();
        
     
        if(!empty($data)){
            array_push($arr,"Data Sebaran Kelas {$data->kode} Semester {$data->semester} Tahun {$data->tahun_akademik} telah diisi sebelumnya . Silahkan isi Data sebaran yang lain .");
            }
        }
        
        if(!empty($arr)){
            $arr = array_unique($arr);
            return redirect()->back()->withErrors($arr);
        }

    
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
            if(!empty($request->kd_kelas[$x])){
                DB::table('sebaran')->insert(['kd_kelas'=>$request->kd_kelas[$x],
                'prodi'=>$request->prodi[$x] ?? $request->user()->prodi,
                'semester'=>$request->semester[$x],
                'mata_kuliah'=>$request->mata_kuliah[$x],
                'tahun_akademik'=>$request->tahun_akademik[$x],
                'dosen_pdpt'=>$request->dosen_pdpt[$x],
                'dosen_mengajar'=>$request->dosen_mengajar[$x]
                ]);
            }
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
                    ->leftJoin('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                    ->leftJoin('table_dosen','sebaran.dosen_pdpt','=','table_dosen.nidn')
                    ->leftJoin('kelas','sebaran.kd_kelas','=','kelas.id')
                    ->select('kelas.tahun','dosen.name','dosen.nidn','table_dosen.name as dosen_pdpt','table_dosen.nidn as nidn_pdpt','sebaran.id','sebaran.mata_kuliah as id_matkul','sebaran.dosen_mengajar','sebaran.kd_kelas as id_kelas','kelas.kode','matkul.kode_matkul','matkul.matkul','sebaran.prodi','sebaran.semester','sebaran.tahun_akademik')
                    ->where('sebaran.id',$id)->first();
                    
        $data['sebaran'] = $sebaran ;
    
        $data_dosen = DB::table('dosen')
                        ->where('prodi',$data['sebaran']->prodi)
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
    public function export_excel(Request $request)
	{
        
            return Excel::download(new SebaranExport($request), 'sebaran.xlsx');
        
    }
    public function export_excel_prodi(Request $request)
	{
        return Excel::download(new SebaranProdiExport($request), 'sebaran.xlsx');
	}
}
