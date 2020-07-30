<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

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
        $id = Auth::user()->prodi;
        $get_prodiAndDosen = 
                            DB::table('dosen')
                            ->join('prodi', 'dosen.prodi', '=', 'prodi.id')
                            ->select('dosen.name','dosen.nidn','dosen.jenis_kelamin','dosen.status','prodi.nama','dosen.id','dosen.bidang')
                            ->distinct('name');
                            
       
        
        
        if(!empty($id)){
        $get_prodiAndDosen = $get_prodiAndDosen->where('dosen.prodi',$id);
        
        }
        
        if(!empty($_GET)){ 
            if(!empty($_GET['prodi'])){
                $prodi = $_GET['prodi'];
                $get_prodiAndDosen->where('prodi.id',$prodi);
              } 
            }
            
        $get_prodiAndDosen = $get_prodiAndDosen->get();
        foreach($get_prodiAndDosen as &$dosen)
        {
            $dosen->jumlah_jam = DB::table('sebaran')->where('dosen_mengajar',$dosen->id)->where('approved', 1)->sum('jam');
        }
     
        
            $data['get_prodiAndDosen'] = $get_prodiAndDosen;
           
        return view('dosen.index',$data);
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
        
        return redirect('dosen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['dosen'] = DB::table('dosen')->where('id',$id)->first();
        $get_name = DB::table('dosen')->where('id', $id)->value('name');
        $data['get_name'] = $get_name;
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
        DB::table('dosen')->where('id',$id)->update(['name'=>$request->name,
                                                    'nidn'=>$request->nidn,
                                                    'jenis_kelamin'=>$request->jenis_kelamin,
                                                    'status'=>$request->status,
                                                    'bidang'=>$request->bidang,]);
                                                    return redirect('dosen');
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
        return redirect('dosen');
    }
}
