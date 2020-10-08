<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KurikulumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kurikulum = DB::table('kurikulum')
        ->join('prodi','prodi.id','=','kurikulum.prodi')
        ->select('prodi.nama as nama_prodi','kurikulum.nama','kurikulum.id')
        ->groupBy('nama')->get();
        $data['kurikulum'] = $kurikulum;
         
        return view('kurikulum.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kurikulum.create');
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
            
            'nama' => 'required',
            
            
        ]);
        $all_prodi = $request->prodi;
        if($all_prodi == 'all'){
            $all = DB::table('prodi')->get();
            foreach ($all as $prodi){
                DB::table('kurikulum')->insert(['nama'=>$request->nama,
                'prodi'=>$prodi->id ?? $request->user()->prodi ]);    
            } 
        }else{
            DB::table('kurikulum')->insert(['nama'=>$request->nama,
            'prodi'=>$request->prodi ?? $request->user()->prodi ]);    
        }
        
        return redirect('kurikulum/create')->with('status', 'Data added successfully, please add new data .');
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
        $data['kurikulum'] = DB::table('kurikulum')->where('id',$id)->first();
        return view('kurikulum.edit',$data);
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
            'prodi' => 'required',
            'nama' => 'required',
            
        ]);
        $all_prodi = $request->prodi;
        if($all_prodi == 'all'){
            $all = DB::table('prodi')->get();
            foreach ($all as $prodi){
                DB::table('kurikulum')->insert(['nama'=>$request->nama,
                'prodi'=>$prodi->id ?? $request->user()->prodi ]);    
            } 
        }else{
            DB::table('kurikulum')->insert(['nama'=>$request->nama,
            'prodi'=>$request->prodi ?? $request->user()->prodi ]);    
        }
         return redirect('kurikulum')->with('status', 'Data updated successfully  .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kurikulum')->where('id',$id)->delete();
        return redirect('kurikulum')->with('status', 'Data deleted successfully .');
    }
}
