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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Dosen
                </h3>
            </div>
            <div class="card-body">

                {{ Form::model($dosen,['url'=>'dosen/'.$dosen->id,'method'=>'put'])}}
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="name" class=" offset-1 col-3">Nama Dosen</label>
                        <div class="col-6">
                            {{ Form::text('name',null,['placeholder'=>'Enter Nama Dosen ','class'=>'form-control ','required'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nidn" class="offset-1 col-3 ">NIDN</label>
                        <div class="col-6">
                            {{ Form::number('nidn',null,['placeholder'=>'Enter NIDN','class'=>'form-control ','required'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="offset-1 col-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-6">
                            {{ Form::select('jenis_kelamin',['Laki-Laki'=>'Laki-Laki','Perempuan'=>'Perempuan'],null,['class'=>'form-control col-md-12'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="offset-1 col-3 col-form-label">Status</label>
                        <div class="col-6">
                            {{ Form::select('status',['Tetap'=>'Tetap','Tidak Tetap'=>'Tidak Tetap'],null,['class'=>'form-control col-md-12'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bidang" class="offset-1 col-3 col-form-label">Bidang</label>
                        <div class="col-6">
                            {{ Form::select('bidang',['Produktif'=>'Produktif','MKDU'=>'MKDU'],null,['class'=>'form-control '])}}
                        </div>
                    </div>

                    {{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control col-md-7','name'=>'prodi',' readonly'])}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">Update</button>
                        <a href="{{ route('dosen.index')}}" class="btn btn-default ">Cancel</a>
                    </div>
                </form>
                {{ Form::close()}}
            </div>
        </div>
    </div>
</div>

@endsection
