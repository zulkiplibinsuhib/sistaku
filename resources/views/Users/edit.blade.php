@extends('layout')
@section('title','Users')
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
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show col-4" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline text-sm-3">
            <div class="card-header">
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Users
                </h3>
            </div>
            <div class="card-body">
                {{ Form::model($users,['url'=>'users/'.$users->id,'method'=>'put'])}}
                <table class="table table-borderless">
                    <tr>
                        <td> <label class="offset-4">Nama</label>
                        <td>{{ Form::text('name',null,['placeholder'=>'Kode users','class'=>'form-control col-10','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td> <label class="offset-4">Email</label>
                        <td>{{ Form::email('email',null,['placeholder'=>'Kode users','class'=>'form-control col-10','required'])}}
                        </td>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><label for="" class="offset-4">Password</label> </td>
                        <td>{{ Form::password('password',null,['placeholder'=>'','class'=>'form-control col-10 ','required'])}}
                        </td>
                    </tr>
                    {{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'prodi','required'])}}
                    {{ Form::hidden('level',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'level','required'])}}


                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update</button>
                    <a href="{{ route('users.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
