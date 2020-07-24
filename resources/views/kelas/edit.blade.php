@extends('layout')
@section('title','Update Data Mata Kuliah')
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
 
    {{ Form::model($kelas,['url'=>'kelas/'.$kelas->id,'method'=>'put'])}}   
    <table class="table table-bordered">
        <tr><td> Kode Kelas <td>{{ Form::text('kode',null,['placeholder'=>'Kode kelas','class'=>'form-control col-md-4','required'])}}</td> </td></tr>
        <tr>
            {{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'prodi',' readonly'])}}
        </tr>
        <tr><td>Semester <td>{{ Form::text('semester',null,['placeholder'=>'Masukkan semester baru','class'=>'form-control col-md-4','required'])}} </td> </td></tr>
        <tr><td>Jumlah Mahasiswa <td> {{ Form::number('mhs',null,['placeholder'=>'jumlah mahasiswa','class'=>'form-control col-md-4','required'])}}</td> </td></tr>
        <tr><td>Keterangan <td> {{ Form::select('keterangan',['karyawan'=>'karyawan','reguler'=>'reguler'],null,['class'=>'form-control col-md-4'])}}</td> </td></tr>
        <tr><td></td><td> 
            {{ Form::submit('Update Data',['class'=>'btn btn-success'])}}
            {{ Link_to('kelas','Kembali',['class'=>'btn btn-danger'])}}
            {{ Form::close()}} 
        </td></tr>
    </table>
@endsection