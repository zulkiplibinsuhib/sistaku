<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Kelas;
use App\Matkul;
use App\Sebaran;
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
        $sebaran = Auth::user()->id;
        $get_prodiAndSebaran = DB::table('sebaran')
                             ->join('prodi','sebaran.prodi', '=', 'prodi.id')
                             ->join('dosen','sebaran.dosen_mengajar','=','dosen.id')
                             ->select('sebaran.approved','sebaran.id','sebaran.kd_kelas','prodi.nama','sebaran.kelas','sebaran.semester','sebaran.mhs','sebaran.mata_kuliah','sebaran.sks','sebaran.jam','sebaran.dosen_mengajar','dosen.name');
                            
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
        
    }
                 
        $get_prodiAndSebaran = $get_prodiAndSebaran->get();
        $data['get_prodiAndSebaran'] = $get_prodiAndSebaran;          
        return view('sebaran.index',$data);
    }
      // Autofill sebaran gagal 

      public function ajax_select(Request $request)
      {
        $kode = $request->kode;
        $kelas= Kelas::where('kode','=',$kode)->first();
        if(isset($kelas)){
            $data = array(
            'kode' => $kelas['kode'],
            'kelas' =>  $kelas['kelas'],
            'semester' =>  $kelas['semester'],
            'mhs' =>  $kelas['mhs'],
            );
           
        return response()->json($data);
        }
    }

    public function ajax_select_matkul(Request $request)
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


        DB::table('sebaran')->insert(['kd_kelas'=>$request->kd_kelas,
                                    'kelas'=>$request->kelas,
                                    'prodi'=>$request->prodi ?? $request->user()->prodi,
                                    'semester'=>$request->semester,
                                    'mhs'=>$request->mhs,
                                    'mata_kuliah'=>$request->mata_kuliah,
                                    'sks'=>$request->sks,
                                    'jam'=>$request->jam,
                                    'dosen_mengajar'=>$request->dosen_mengajar]);
                                    
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
        $data_prodi = DB::table('prodi')->get();
        $data_kode = DB::table('kelas')->pluck('kode');
        $data_kelas = DB::table('kelas')->pluck('kelas');
        $data_matkul = DB::table('matkul')->pluck('matkul');
        $data_dosen = DB::table('dosen')->get();
        $data['data_prodi'] = $data_prodi;
        $data['data_kode'] = $data_kode;
        $data['data_kelas'] = $data_kelas;
        $data['data_matkul'] = $data_matkul;
        $data['data_dosen'] = $data_dosen;
        $data['sebaran'] = DB::table('sebaran')->where('id',$id)->first();
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
                                                        'semester'=>$request->semester,
                                                        'mhs'=>$request->mhs,
                                                        'mata_kuliah'=>$request->mata_kuliah,
                                                        'sks'=>$request->sks,
                                                        'jam'=>$request->jam,
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
