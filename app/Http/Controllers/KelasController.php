<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use DB;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index() 
    {
        $data['kelas'] = DB::table('kelas')->get();
        $id = Auth::user()->prodi;
        $cari_tahun = DB::table('kelas')->groupBy('tahun')->get();
        $cari_semester = DB::table('matkul')->groupBy('semester')->get();
        $get_prodiAndKelas = DB::table('kelas')
                                ->join('prodi', 'kelas.prodi', '=', 'prodi.id')
                                ->select('kelas.kelas','kelas.kode','prodi.nama','kelas.semester','kelas.mhs','kelas.keterangan','prodi.id','kelas.id','kelas.tahun')->orderBy('kode');
        if(!empty($id)){
            $get_prodiAndKelas = $get_prodiAndKelas->where('kelas.prodi',$id);
        }
        if(!empty($_GET)){ 
            if(!empty($_GET['prodi'])){
                $prodi = $_GET['prodi'];
                $get_prodiAndKelas->where('prodi.id',$prodi);
              } 
            if(!empty($_GET['tahun'])){
                $tahun = $_GET['tahun'];
                $get_prodiAndKelas->where('kelas.tahun',$tahun);
              }
              if(!empty($_GET['semester'])){
                $semester = $_GET['semester'];
                $get_prodiAndKelas->where('kelas.semester',$semester);
              } 
            }
            
        $get_prodiAndKelas = $get_prodiAndKelas->get();
        $data['get_prodiAndKelas'] = $get_prodiAndKelas;
        $data['cari_semester'] = $cari_semester;          
        $data['cari_tahun'] = $cari_tahun;
       
        return view('kelas.index',$data);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kurikulum = DB::table('kurikulum')->groupBy('nama')->get();
        $data_prodi = DB::table('prodi')->pluck('nama');
        $data['data_prodi'] = $data_prodi;
        $data['kurikulum'] = $kurikulum;
        return view('kelas.create',$data);
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
            'kode' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'mhs' => 'required',
            'keterangan' => 'required',
        ]);
        DB::table('kelas')->insert(['kode'=>$request->kode,
                                    'kelas'=>$request->kelas,
                                    'prodi'=>$request->prodi ?? $request->user()->prodi,
                                    'semester'=>$request->semester,
                                    'tahun'=>$request->tahun,
                                    'mhs'=>$request->mhs,
                                    'keterangan'=>$request->keterangan]);
                                     return redirect('kelas/create')->with('status', 'Data added successfully, please add new data .');
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

   
    public function edit($id)
    {
        $data['kelas'] = DB::table('kelas')->where('id',$id)->first();
        return view('kelas.edit',$data);
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
            'kode' => 'required',
            'kelas' => 'required',
            'prodi' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'mhs' => 'required',
            'keterangan' => 'required',
        ]);
        DB::table('kelas')->where('id',$id)->update(['kode'=>$request->kode,
                                                    'prodi'=>$request->prodi,
                                                    'kelas'=>$request->kelas,
                                                    'semester'=>$request->semester,
                                                    'tahun'=>$request->tahun,
                                                    'mhs'=>$request->mhs,
                                                    'keterangan'=>$request->keterangan]);
                                                    return redirect('kelas')->with('status', 'Data updated successfully  .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kelas')->where('id',$id)->delete();
        return redirect('kelas')->with('status', 'Data deleted successfully .');
    }
}
