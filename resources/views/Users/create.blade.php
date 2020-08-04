@extends('layout')
@section('title','Input Users')
@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {{ Form::open(['url'=>'users'])}}
    <table class="table table-bordered">
       
        <tr><td>Email</td><td>{{ Form::email('email',null,['placeholder'=>'example@gmail.com  ','class'=>'form-control','required'])}}</td></tr>
        <tr><td>Username</td><td>{{ Form::text('name',null,['placeholder'=>'Nama ','class'=>'form-control','required'])}}</td></tr>
        <tr><td><label for="prodi">Prodi</label></td><td><select name="prodi"  class="form-control col-md-4">
                <option selected disabled>Pilih Prodi</option>
                <option value="all">All Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach 
            </select></td></tr>
        <tr><td>Level</td><td>{{ Form::select('level',['prodi'=>'prodi','admin'=>'admin'],null,['class'=>'form-control col-md-4'])}}</td></tr>
        <tr><td>Password</td><td>{{ Form::text('password',null,['placeholder'=>'Enter Password','class'=>'form-control','required'])}}</td></tr>
        <tr><td></td><td>    {{ Form::submit('Simpan Data',['class'=>'btn btn-success'])}}
                {{ Link_to('prodi','Kembali',['class'=>'btn btn-danger'])}}
                {{ Form::close()}}</td></tr>
    </table>
@endsection