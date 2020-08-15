@extends('layout')
@section('title','SISTAKU')
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
<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline text-sm-3">
            <div class="card-header">
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Input User
                </h3>
            </div>
            <div class="card-body">
            {{ Form::open(['url'=>'users'])}}
    <table class="table table-borderless">
       
        <tr><td><label>Email</label> </td><td>{{ Form::email('email',null,['placeholder'=>'example@gmail.com  ','class'=>'form-control col-md-4','required'])}}</td></tr>
        <tr><td><label for="">Username</label> </td><td>{{ Form::text('name',null,['placeholder'=>'Username ','class'=>'form-control col-md-4','required'])}}</td></tr>
        <tr><td><label for="prodi">Prodi</label></td><td><select name="prodi"  class="form-control col-md-4">
                <option selected disabled>Pilih Prodi</option>
                <option value="all">All Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach 
            </select></td></tr>
        <tr><td><label for="">Level</label> </td><td>{{ Form::select('level',['prodi'=>'prodi','admin'=>'admin'],null,['class'=>'form-control col-md-4'])}}</td></tr>
        <tr><td><label for="">Password</label> </td><td>{{ Form::text('password',null,['placeholder'=>'Enter Password','class'=>'form-control col-md-4','required'])}}</td></tr>
        
    </table>
    <div class="card-footer">
                    <button type="submit" class="btn btn-info">Input</button>
                    <a href="{{ route('users.index')}}" class="btn btn-default float-right">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

   
@endsection