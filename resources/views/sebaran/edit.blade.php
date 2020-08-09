@extends('layout')
@section('title','Update Sebaran ')
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

{{ Form::model($sebaran,['url'=>'sebaran/'.$sebaran->id,'method'=>'put'])}}
<table class="table table-bordered">

    <tr>
        <td><label for="kd_kelas">Kode Kelas</label></td>
        <td>{{ Form::text('kd_kelas',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'kd_kelas',' readonly'])}}
    </tr>
    <tr>
        <td><label for="kelas">Kelas</label></td>
        <td>{{ Form::text('kelas',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'kelas',' readonly'])}}
        </td>
    </tr>
    <tr> 
        
       {{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'prodi',' readonly'])}}      
    </tr>
    <tr>
        <td>Tahun Akademik </td>
        <td>{{ Form::text('tahun',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'tahun','readonly'])}}
        </td>
    </tr>
    <tr>
        <td>Semester </td>
        <td>{{ Form::text('semester',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'semester','readonly'])}}
        </td>
    </tr>
    <tr>
        <td>Mahasiswa</td>
        <td>{{ Form::text('mhs',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'mhs','id'=>'mhs-sebaran','readonly'])}}
        </td>
    </tr>
    <tr>
    <td>Mata Kuliah</td>
        <td>{{ Form::text('mata_kuliah',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'mata_kuliah','id'=>'mhs-sebaran','readonly'])}}
        </td>
    </tr>
    <tr>
        <td>SKS</td>
        <td>{{ Form::text('sks',null,['placeholder'=>'','class'=>'form-control col-md-4','id'=>'sks-edit','readonly'])}}
        </td>
    </tr>
    <tr>
        <td>Jam</td>
        <td>{{ Form::text('jam',null,['placeholder'=>'Jumlah Jam Mengajar','class'=>'form-control col-md-4','readonly'])}}
        </td>
    </tr>
    <tr>
        <td><label for="dosen">Dosen PDPT</label></td>
        <td><select class="form-control col-md-4" name="dosen_mengajar" >
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen->id}}">{{ $dosen->name}} </option>
                @endforeach
            </select></td>
    </tr>
    <tr>
        <td><label for="dosen">Dosen Mengajar</label></td>
        <td><select class="form-control col-md-4" name="dosen_mengajar" >
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen->id}}">{{ $dosen->name}}</option>
                @endforeach
            </select></td>
    </tr>

    <tr>
        <td></td>
        <td>
            {{ Form::submit('Update Data',['class'=>'btn btn-success'])}}
            {{ Link_to('sebaran','Kembali',['class'=>'btn btn-danger'])}}
            {{ Form::close()}}
        </td>
    </tr>
</table>
@endsection
