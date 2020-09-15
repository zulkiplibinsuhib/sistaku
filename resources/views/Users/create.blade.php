@extends('layout')
@section('title','Users')
@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show col-4" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
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

                    <tr>
                        <td><label class="offset-4">Email</label> </td>
                        <td>{{ Form::email('email',null,['placeholder'=>'example@gmail.com  ','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label for="" class="offset-4">Username</label> </td>
                        <td>{{ Form::text('name',null,['placeholder'=>'Username ','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label for="prodi" class="offset-4 ">Prodi</label></td>
                        <td>
                            <select name="prodi" class="form-control col-10">
                                <option selected disabled>Pilih Prodi</option>
                                <option value="all">All Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    <tr>
                        <td><label for="" class="offset-4">Level</label> </td>
                        <td>{{ Form::select('level',['prodi'=>'Prodi','admin'=>'Admin'],null,['class'=>'form-control col-10'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label for="" class="offset-4">Password</label> </td>
                        <td>{{ Form::text('password',null,['placeholder'=>'Enter Password','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>

                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Input</button>
                    <a href="{{ route('users.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
