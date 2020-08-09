<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Kelas;
use App\Matkul;
use App\Sebaran;
use App\Dosen;
use App\Prodi;

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
        $cari_tahun = DB::table('sebaran')->groupBy('tahun')->get();
        $cari_semester = DB::table('sebaran')->groupBy('semester')->get();
        $sebaran = Auth::user()->id;
        $get_prodiAndSebaran = DB::table('sebaran')
                             ->join('prodi','sebaran.prodi', '=', 'prodi.id')
                             ->join('dosen','sebaran.dosen_mengajar','=','dosen.nidn')
                             ->select('sebaran.tahun','sebaran.approved','sebaran.id','sebaran.kd_kelas','prodi.nama','sebaran.kelas','sebaran.semester','sebaran.mhs','sebaran.mata_kuliah','sebaran.sks','sebaran.jam','sebaran.teori','sebaran.praktek','sebaran.dosen_pdpt','sebaran.dosen_mengajar','dosen.name')
                             ->groupBy('id');
                            
        if($id){
        $get_prodiAndSebaran = $get_prodiAndSebaran->where('sebaran.prodi',$id);
       } 
       if(!empty($_GET)){
          if(!empty($_GET['prodi'])){
            $prodi = $_GET['prodi'];
            $get_prodiAndSebaran->where('prodi.id',$prodi);
          } 
          if(!empty($_GET['semester'])){
            $semester = $_GET['semester'];
            $get_prodiAndSebaran->where('sebaran.semester',$semester);
          } 
          if(!empty($_GET['tahun'])){
            $tahun = $_GET['tahun'];
            $get_prodiAndSebaran->where('sebaran.tahun',$tahun);
          } 
        
    }
                 
        $get_prodiAndSebaran = $get_prodiAndSebaran->get();
        $data['get_prodiAndSebaran'] = $get_prodiAndSebaran;          
        $data['cari_tahun'] = $cari_tahun;          
        $data['cari_semester'] = $cari_semester;          
        return view('sebaran.index',$data);
    }
    public function ajax_create(Request $request)
    {
        $id =  Auth::user()->prodi;

        $get = $request->get;
        $get_data = DB::table('matkul')
                            ->join ('kelas', 'matkul.semester', '=', 'kelas.semester')
                            
                            ->select('matkul.tahun','matkul.jam_minggu','matkul.teori','matkul.praktek','matkul.kode_matkul','matkul.matkul','matkul.sks','matkul.teori','matkul.praktek','matkul.jam_minggu','matkul.kurikulum','kelas.semester','matkul.teori','matkul.praktek','matkul.jam_minggu','kelas.kode','kelas.mhs','kelas.kelas','kelas.prodi')
         
                            ->where ('kelas.semester',$get);
                        
      
      if($id){
        $get_data = $get_data->where('kelas.prodi',$id)->where('matkul.prodi',$id)->get();
      }

      $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
      
      return response()->json(['data'=>$get_data,$data_dosen]);
      
  }

      public function ajax_select(Request $request)
      {
       $tahun = $request->tahun;
       $get_data = DB::table('matkul')->where('tahun',$tahun)->groupBy('semester')->get();
           
           return response()->json(['data'=>$get_data]);
        }
    

    public function ajax_select_matkul(Request $request)
      {
        $kode = $request->kode;
        // $sms = $request->sms;
       
        $matkul= Matkul::where('matkul','=',$kode)->first();
        // $matkul= Matkul::where('semester','=',$sms)->first();
        if(isset($matkul)){
            $data = array(
            'sks' =>  $matkul['sks'],
            ); 
        return response()->json($data);
        }
    }

    public function ajax_select_matkul_edit(Request $request)
      {
        $kode = $request->kode;
        $matkul= Matkul::where('matkul','=',$kode)->first();
        if(isset($matkul)){
            $data = array(
            'sks' =>  $matkul['sks'],
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
        $data['get_data'] = Dosen::all();
        $data['sebaran'] = DB::table('sebaran')->get();
        $data_prodi = DB::table('prodi')->pluck('nama');
        $data_kode = DB::table('kelas')->where('prodi',Auth::user()->prodi)->get();
        $data_kelas = DB::table('kelas')->pluck('kelas');
        $data_matkul = DB::table('matkul')->where('prodi',Auth::user()->prodi)->get();
        $data_dosen = DB::table('dosen')->where('prodi',Auth::user()->prodi)->get();
        $data['data_prodi'] = $data_prodi;
        $data['data_kode'] = $data_kode;
        $data['data_kelas'] = $data_kelas;
        $data['data_matkul'] = $data_matkul;
        $data['data_dosen'] = $data_dosen;
        
        return view('sebaran.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get = DB::table('sebaran')->where('tahun',$request->tahun[0])->where('semester',$request->semester[0])->first();
        if(!empty($get)){
            return redirect()->back()->withErrors(["Warning !!! <br> Data Sebaran Semester {$request->semester[0]} Tahun {$request->tahun[0]} telah diisi sebelumnya .<br> Silahkan isi Data sebaran yang lain :)"]);
        }
        $validatedData = $request->validate([
            'kd_kelas' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'mhs' => 'required',
            'mata_kuliah' => 'required',
            'sks' => 'required',
            'jam' => 'required',
            'dosen_pdpt' => 'required',
            'dosen_mengajar' => 'required'
        ]);
            
        for($x=0;$x<count($request->kd_kelas);$x++){
            DB::table('sebaran')->insert(['kd_kelas'=>$request->kd_kelas[$x],
            'kelas'=>$request->kelas[$x],
            'prodi'=>$request->prodi[$x] ?? $request->user()->prodi,
            'semester'=>$request->semester[$x],
            'tahun'=>$request->tahun[$x],
            'mhs'=>$request->mhs[$x],
            'mata_kuliah'=>$request->mata_kuliah[$x],
            'sks'=>$request->sks[$x],
            'teori'=>$request->teori[$x],
            'praktek'=>$request->praktek[$x],
            'jam'=>$request->jam[$x],
            'dosen_pdpt'=>$request->dosen_pdpt[$x],
            'dosen_mengajar'=>$request->dosen_mengajar[$x]
            ]);
        }
        
                                    
        return redirect('sebaran');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['get_data'] = Dosen::all();
        $data_prodi = DB::table('prodi')->get();
        $data_kode = DB::table('kelas')->pluck('kode');
        $data_kelas = DB::table('kelas')->pluck('kelas');
        $data_matkul = DB::table('matkul')->pluck('matkul');
        
        $data['sebaran'] = DB::table('sebaran')->where('id',$id)->first();
        $data_dosen = DB::table('dosen')
                        ->where('dosen.prodi',$data['sebaran']->prodi)
                        ->get();
        $data['data_prodi'] = $data_prodi;
        $data['data_kode'] = $data_kode;
        $data['data_kelas'] = $data_kelas;
        $data['data_matkul'] = $data_matkul;
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
            'kelas' => 'required',
            'semester' => 'required',
            'mhs' => 'required',
            'mata_kuliah' => 'required',
            'sks' => 'required',
            'jam' => 'required',
            'dosen_mengajar' => 'required'
        ]);
    
        DB::table('sebaran')->where('id',$id)->update(['kd_kelas'=>$request->kd_kelas,
                                                        'kelas'=>$request->kelas,
                                                        'prodi'=>$request->prodi,
                                                       
                                                        'tahun'=>$request->tahun,
                                                        'semester'=>$request->semester,
                                                        'mhs'=>$request->mhs,
                                                        'mata_kuliah'=>$request->mata_kuliah,
                                                        'sks'=>$request->sks,
                                                        'jam'=>$request->jam,
                                                        'dosen_pdpt'=>$request->dosen_pdpt,
                                                        'dosen_mengajar'=>$request->dosen_mengajar]);
                                                        return redirect('sebaran');
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
        return redirect('sebaran');
    }
}
