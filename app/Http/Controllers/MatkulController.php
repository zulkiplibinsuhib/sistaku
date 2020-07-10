<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->prodi;
        $get_ProdiAndMatkul = DB::table('matkul')
                            ->join ('prodi', 'matkul.prodi', '=', 'prodi.id')
                            ->select('matkul.id','matkul.kode_matkul','matkul.matkul','matkul.sks','matkul.kurikulum','prodi.nama');
                            $get_ProdiAndMatkul = $get_ProdiAndMatkul->where('matkul.prodi',$id); 
        
        if(!empty($_GET)){
            $kurikulum = $_GET['kurikulum'];
            $get_ProdiAndMatkul->where('matkul.kurikulum',$kurikulum);
            
        }
       
        $get_ProdiAndMatkul = $get_ProdiAndMatkul->get();
        $data['get_ProdiAndMatkul'] = $get_ProdiAndMatkul;
        
        
        //$data_prodi = new Prodi();
       
        return view('matkul.index',$data); 
        
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
        return view('matkul.create',$data);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('matkul')->insert(['kode_matkul'=>$request->kode_matkul,
                                    'matkul'=>$request->matkul,
                                    'sks'=>$request->sks,
                                    'kurikulum'=>$request->kurikulum,
                                    'prodi'=>$request->prodi ?? $request->user()->prodi ]); 
        return redirect('matkul');
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
        $data_prodi = DB::table('prodi')->pluck('nama');
        $data['data_prodi'] = $data_prodi;
        $data['matkul'] = DB::table('matkul')->where('id',$id)->first();
        return view('matkul.edit',$data); 
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
        DB::table('matkul')->where('id',$id)->update(['kode_matkul'=>$request->kode_matkul,
                                                        'matkul'=>$request->matkul,
                                                        'sks'=>$request->sks,
                                                        'kurikulum'=>$request->kurikulum,
                                                        'prodi'=>$request->prodi]);
                                                        return redirect('matkul');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('matkul')->where('id',$id)->delete();
        return redirect('matkul');
    }
}
