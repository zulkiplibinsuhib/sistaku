<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Matkul;

class MatkulController extends Controller
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
        $id = Auth::user()->prodi;
        
        $cari_semester = DB::table('matkul')->groupBy('semester')->get();
        $get_ProdiAndMatkul = DB::table('matkul')
                            ->leftJoin ('prodi', 'matkul.prodi', '=', 'prodi.id')
                            ->select('matkul.id','matkul.kode_matkul','matkul.matkul','matkul.sks','matkul.teori','matkul.praktek','matkul.jam_minggu','matkul.kurikulum','matkul.semester','matkul.teori','matkul.praktek','matkul.jam_minggu','prodi.nama');
                             
        if($id){
            $get_ProdiAndMatkul = $get_ProdiAndMatkul->where('matkul.prodi',$id);
        }
        if(!empty($_GET)){
            if(!empty($_GET['prodi'])){
                $prodi = $_GET['prodi'];
                $get_ProdiAndMatkul->where('prodi.id',$prodi);
              } 
             
              if(!empty($_GET['semester'])){
                $semester = $_GET['semester'];
                $get_ProdiAndMatkul->where('matkul.semester',$semester);
              } 
        }
       
        $get_ProdiAndMatkul = $get_ProdiAndMatkul->get();
       
        $data['get_ProdiAndMatkul'] = $get_ProdiAndMatkul;
        $data['cari_semester'] = $cari_semester;          
        
        
        
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
        $kurikulum = DB::table('kurikulum')->groupBy('nama')->get();
        $data_prodi = DB::table('prodi')->pluck('nama');
        $data['data_prodi'] = $data_prodi;
        $data['kurikulum'] = $kurikulum ;
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
        $data = DB::table('matkul')
                ->where('kode_matkul',$request->kode_matkul)
                ->first();
        if(!empty($data)){
            return redirect()->back()->withErrors("Mata Kuliah dengan kode {$data->kode_matkul} sudah ada .");       
         }
        $validatedData = $request->validate([
            'matkul' => 'required',
            'sks' => 'required',
            'teori' => 'required',
            'praktek' => 'required',
            'jam_minggu' => 'required',
            'kurikulum' => 'required',
            'semester' => 'required',
            
            
        ]);
        $all_prodi = $request->prodi;
        if($all_prodi == 'all'){
            $all = DB::table('prodi')->get();
            foreach ($all as $prodi){
                DB::table('matkul')->insert(['kode_matkul'=>$request->kode_matkul,
                'matkul'=>$request->matkul,
                'sks'=>$request->sks,
                'teori'=>$request->teori,
                'praktek'=>$request->praktek,
                'jam_minggu'=>$request->jam_minggu,
                'kurikulum'=>$request->kurikulum,
                'semester'=>$request->semester,
               
                'prodi'=>$prodi->id ?? $request->user()->prodi ]);    
            } 
        }else{
            DB::table('matkul')->insert(['kode_matkul'=>$request->kode_matkul,
            'matkul'=>$request->matkul,
            'sks'=>$request->sks,
            'teori'=>$request->teori,
            'praktek'=>$request->praktek,
            'jam_minggu'=>$request->jam_minggu,
            'kurikulum'=>$request->kurikulum,
            'semester'=>$request->semester,
            'prodi'=>$request->prodi ?? $request->user()->prodi ]);    
        }
        
        return redirect('matkul/create')->with('status', 'Data added successfully, please add new data .');
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
        $kurikulum = DB::table('kurikulum')->groupBy('nama')->get();
        $data_prodi = DB::table('prodi')->pluck('nama');
        $data['data_prodi'] = $data_prodi;
        $data['kurikulum'] = $kurikulum ;
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
        $validatedData = $request->validate([
            'matkul' => 'required',
            'sks' => 'required',
            'teori' => 'required',
            'praktek' => 'required',
            'jam_minggu' => 'required',
            'kurikulum' => 'required',
            'semester' => 'required',
           
            
            'prodi' => 'required',
            
        ]);
        DB::table('matkul')->where('id',$id)->update(['kode_matkul'=>$request->kode_matkul,
                                                        'matkul'=>$request->matkul,
                                                        'sks'=>$request->sks,
                                                        'teori'=>$request->teori,
                                                        'praktek'=>$request->praktek,
                                                        'jam_minggu'=>$request->jam_minggu,
                                                        'kurikulum'=>$request->kurikulum,
                                                        'semester'=>$request->semester,
                                                    
                                                        'prodi'=>$request->prodi]);
                                                        return redirect('matkul')->with('status', 'Data updated successfully  .');
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
        return redirect('matkul')->with('status', 'Data deleted successfully .');
    }
}
