<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BidangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $bidang = DB::table('bidang_dosen')
        ->join('prodi','prodi.id','=','bidang_dosen.prodi')
        ->select('prodi.nama as nama_prodi','bidang_dosen.nama_bidang','bidang_dosen.id')
        ->groupBy('nama_bidang')->get();
        $data['bidang'] = $bidang;
         
        return view('bidang.index',$data);
    }
    public function create()
    {
        return view('bidang.create');
    }
    public function store(Request $request)
    {
        $data = DB::table('bidang_dosen')
                ->where('nama_bidang',$request->nama_bidang)
                ->first();
        if(!empty($data)){
            return redirect()->back()->withErrors("Bidang {$data->nama_bidang} sudah ada .");       
         }
        $validatedData = $request->validate([
            
            'nama_bidang' => 'required',
            
            
        ]);
        $all_prodi = $request->prodi;
        if($all_prodi == 'all'){
            $all = DB::table('prodi')->get();
            foreach ($all as $prodi){
                DB::table('bidang_dosen')->insert(['nama_bidang'=>$request->nama_bidang,
                'prodi'=>$prodi->id ?? $request->user()->prodi ]);    
            } 
        }else{
            DB::table('bidang_dosen')->insert(['nama_bidang'=>$request->nama_bidang,
            'prodi'=>$request->prodi ?? $request->user()->prodi ]);    
        }
        
        return redirect('bidang/create')->with('status', 'Data added successfully, please add new data .');
    }
    public function edit($id)
    {
        $data['bidang_dosen'] = DB::table('bidang_dosen')->where('id',$id)->first();
        return view('bidang.edit',$data);
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'prodi' => 'required',
            'nama_bidang' => 'required',
            
        ]);
        $all_prodi = $request->prodi;
        if($all_prodi == 'all'){
            $all = DB::table('prodi')->get();
            foreach ($all as $prodi){
                DB::table('bidang_dosen')->insert(['nama_bidang'=>$request->nama_bidang,
                'prodi'=>$prodi->id ?? $request->user()->prodi ]);    
            } 
        }else{
            DB::table('bidang_dosen')->insert(['nama_bidang'=>$request->nama_bidang,
            'prodi'=>$request->prodi ?? $request->user()->prodi ]);    
        }
         return redirect('bidang')->with('status', 'Data updated successfully  .');
    }
    public function destroy($id)
    {
        DB::table('bidang_dosen')->where('id',$id)->delete();
        return redirect('bidang')->with('status', 'Data deleted successfully .');
    }
}
