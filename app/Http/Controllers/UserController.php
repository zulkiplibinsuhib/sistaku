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
        $data['users'] = DB::table('users')->get();
        return view ('users.index',$data);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $data)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'prodi' => 'required',
        //     'level' => 'required',
        //     'password' => 'required'
            
        // ]);
        {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'prodi' => $data['prodi'],
                'level' => 'prodi',
                'password' => Hash::make($data['password']),
            ]);
        }
        

    }

    public function edit($id)
    {
        $data['prodi'] = DB::table('users')->where('id',$id)->first();
        return view('users.edit',$data);
    }

    public function update(Request $request, $id)
    {
        DB::table('users')->where('id',$id)->update(['name'=>$request->name,
                                                    'email'=>$request->email,
                                                    'prodi'=>$request->prodi,
                                                    'level'=>$request->level,
                                                    'password'=>$request->password,]);
                                                    return redirect('prodi');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return redirect('users');
    }

}
