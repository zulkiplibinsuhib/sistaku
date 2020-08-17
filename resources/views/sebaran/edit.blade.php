@extends('layout')
@section('title','Update Sebaran ')
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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Sebaran
                </h3>
            </div>
            <div class="card-body">
                
{{ Form::model($sebaran,['url'=>'sebaran/'.$sebaran->id,'method'=>'put'])}}
<table class="table table-borderless">

    <tr>
        <td><label for="kd_kelas" class="offset-3">Kode Kelas</label></td>
        <td>{{ Form::text('kd_kelas',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'kd_kelas',' readonly'])}}
    </tr>
    <tr>
        <td><label for="kelas" class="offset-3">Kelas</label></td>
        <td>{{ Form::text('kelas',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'kelas',' readonly'])}}
        </td>
    </tr>
    <tr> 
        
       {{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'prodi',' readonly'])}}      
    </tr>
    <tr>
        <td><label class="offset-3">Tahun Akademik</label> </td>
        <td>{{ Form::text('tahun',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'tahun','readonly'])}}
        </td>
    </tr>
    <tr>
        <td><label class="offset-3">Semester</label> </td>
        <td>{{ Form::text('semester',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'semester','readonly'])}}
        </td>
    </tr>
    <tr>
        <td><label class="offset-3">Mahasiswa </label> </td>
        <td>{{ Form::text('mhs',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'mhs','id'=>'mhs-sebaran','readonly'])}}
        </td>
    </tr>
    <tr>
    <td><label class="offset-3">Mata Kuliah</label> </td>
        <td>{{ Form::text('mata_kuliah',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'mata_kuliah','id'=>'mhs-sebaran','readonly'])}}
        </td>
    </tr>
    <tr>
        <td><label class="offset-3">SKS</label> </td>
        <td>{{ Form::text('sks',null,['placeholder'=>'','class'=>'form-control col-10','id'=>'sks-edit','readonly'])}}
        </td>
    </tr>
    <tr>
        <td><label class="offset-3">Jam</label> </td>
        <td>{{ Form::text('jam',null,['placeholder'=>'Jumlah Jam Mengajar','class'=>'form-control col-10','readonly'])}}
        </td>
    </tr>
    <tr>
        <td><label class="offset-3" for="dosen">Dosen PDPT</label></td>
        <td><select class="form-control col-10" name="dosen_mengajar" >
                <option selected disabled >Pilih Dosen Kembali</option>
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen->id}}">{{ $dosen->name}} </option>
                @endforeach
            </select></td>
    </tr>
    <tr>
        <td><label class="offset-3" for="dosen">Dosen Mengajar</label></td>
        <td>
            <select class="form-control col-10" name="dosen_mengajar" >
                <option selected disabled >Pilih Dosen Kembali</option>
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen->id}}">{{ $dosen->name}}</option>
                @endforeach
            </select></td>
    </tr>

</table>
<div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update</button>
                    <a href="{{ route('sebaran.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
