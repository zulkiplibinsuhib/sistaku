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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Dosen
                </h3>
            </div>
            <div class="card-body">

            {{ Form::model($dosen,['url'=>'dosen/'.$dosen->id,'method'=>'put'])}}
            <form class="form-horizontal">
                    <div class="form-group row">
                    <label for="name" class="col-md-4 ">Nama Dosen</label>
                        <div class="col-md-2">
                        {{ Form::text('name',null,['placeholder'=>'Enter Nama Dosen ','class'=>'form-control col-md','required'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="nidn" class="col-md-4 ">NIDN</label>
                        <div class="col-md-2">
                        {{ Form::number('nidn',null,['placeholder'=>'Enter NIDN','class'=>'form-control ','required'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="jenis_kelamin" class="col-md-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-2">
                        {{ Form::select('jenis_kelamin',['Laki-Laki'=>'Laki-Laki','Perempuan'=>'Perempuan'],null,['class'=>'form-control col-md-12'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="status" class="col-md-4 col-form-label">Status</label>
                        <div class="col-md-2">                  
                        {{ Form::select('status',['Tetap'=>'Tetap','Tidak Tetap'=>'Tidak Tetap'],null,['class'=>'form-control col-md-12'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="bidang" class="col-md-4 col-form-label">Bidang</label>
                        <div class="col-md-2">
                         {{ Form::select('bidang',['Produktif'=>'Produktif','MKDU'=>'MKDU'],null,['class'=>'form-control '])}}
                         </div>
                    </div>

                    @if(empty(Auth::user()->prodi))
                    <div class="form-group row">
                    <label for="prodi" class="col-md-4 col-form-label">Prodi</label>
                    <div class="col-md-2">
                    <select name="prodi" class="form-control">
                        <option selected disabled>Pilih Prodi</option>
                        <option value="all">All Prodi</option>
                        @foreach(App\Prodi::all() as $prodi)
                        <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                        @endforeach
                    </select>
                    </div>
                    </div>
    
                    @endif
                    <div class="card-footer">
                            <button type="submit" class="btn btn-info">Input</button>
                            <a href="{{ route('dosen.index')}}" class="btn btn-default float-right">Cancel</a>
                        </div>
                </form>
                {{ Form::close()}} 
            </div>
        </div>
    </div>
</div>
 
@endsection