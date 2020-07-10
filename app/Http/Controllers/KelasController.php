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
        $get_prodiAndKelas = DB::table('kelas')
                                ->join('prodi', 'kelas.prodi', '=', 'prodi.id')
                                ->select('kelas.kode','prodi.nama','kelas.semester','kelas.mhs','kelas.keterangan','prodi.id');
      
        if(!empty($id)){
            $get_prodiAndKelas = $get_prodiAndKelas->where('kelas.prodi',$id);
        }
        $get_prodiAndKelas = $get_prodiAndKelas->get();
        $data['get_prodiAndKelas'] = $get_prodiAndKelas;
       
        return view('kelas.index',$data);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_prodi = DB::table('prodi')->pluck('nama');
        $data['data_prodi'] = $data_prodi;
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
        DB::table('kelas')->insert(['kode'=>$request->kode,
                                    'kelas'=>$request->kelas,
                                    'prodi'=>$request->prodi ?? $request->user()->prodi,
                                    'semester'=>$request->semester,
                                    'mhs'=>$request->mhs,
                                    'keterangan'=>$request->keterangan]);
                                     return redirect('kelas');
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
        DB::table('kelas')->where('id',$id)->update(['kode'=>$request->kode,
                                                    'prodi'=>$request->prodi,
                                                    'semester'=>$request->semester,
                                                    'mhs'=>$request->mhs,
                                                    'keterangan'=>$request->keterangan]);
                                                    return redirect('kelas');
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
        return redirect('kelas');
    }
}
