<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = DB::table('users')
                        ->join('prodi','users.prodi','=','prodi.id')
                        ->select('users.email','users.name','users.level','prodi.nama','users.id')
                        ->get();
        return view ('users.index',$data);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $data)
    {
        $validatedData = $data->validate([
            'name' => 'required',
            'email' => 'required',
            'prodi' => 'required',
            'level' => 'required',
            'password' => 'required'
            
        ]);
        
           User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'prodi' => $data['prodi'],
                'level' => 'prodi',
                'password' => Hash::make($data['password'])
            ]);
            return redirect('users')->with('status', 'Data added successfully, please add new data .');
        
        

    }

    public function edit($id)
    {
        $data['users'] = DB::table('users')->where('id',$id)->first();
        return view('users.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'level' => 'required',
            'password' => 'required'
            
        ]);
        DB::table('users')->where('id',$id)->update(['name'=>$request->name,
                                                    'email'=>$request->email,
                                                    'prodi'=>$request->prodi,
                                                    'level'=>$request->level,
                                                    'password'=>$request->password,]);
                                                    return redirect('users')->with('status', 'Data updated successfully  .');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('users')->with('status', 'Data deleted successfully .');
    }

}
