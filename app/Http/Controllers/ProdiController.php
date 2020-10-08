<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProdiController extends Controller
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
        $data['prodi'] = DB::table('prodi');
         if(!empty($_GET)){ 
            if(!empty($_GET['prodi'])){
                $prodi = $_GET['prodi'];
                $data['prodi'] = $data['prodi']->where('prodi.id',$prodi);
              } 
            }
            $data['prodi'] = $data['prodi']->get();
        
        return view('prodi.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = DB::table('prodi')
                ->where('kode',$request->kode)
                ->first();
        if(!empty($data)){
            return redirect()->back()->withErrors("Program Studi dengan kode {$data->kode} sudah ada .");       
         }
        $validatedData = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            
        ]);
        DB::table('prodi')->insert(['kode'=>$request->kode,
                                    'nama'=>$request->nama]);
        return redirect('prodi/create')->with('status', 'Data added successfully, please add new data .');
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
        $data['prodi'] = DB::table('prodi')->where('id',$id)->first();
        return view('prodi.edit',$data);
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
            'nama' => 'required',
            
        ]);
        DB::table('prodi')->where('id',$id)->update(['kode'=>$request->kode,
                                                    'nama'=>$request->nama]);
                                                        return redirect('prodi')->with('status', 'Data updated successfully  .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('prodi')->where('id',$id)->delete();
        return redirect('prodi')->with('status', 'Data deleted successfully .');
    }
}
