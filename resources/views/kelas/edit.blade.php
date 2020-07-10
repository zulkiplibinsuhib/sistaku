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
    Kode Kelas : {{ Form::text('kode',null,['placeholder'=>'Kode kelas'])}}
    <br>
    Program Studi : {{ Form::text('prodi',null,['placeholder'=>'program studi'])}}
    <br>
    Semester : {{ Form::number('semester',null,['placeholder'=>'semester'])}}
    <br>
    Jumlah Mahasiswa : {{ Form::number('mhs',null,['placeholder'=>'jumlah mahasiswa'])}}
    <br>
    Keterangan : {{ Form::select('keterangan',['karyawan'=>'karyawan','reguler'=>'reguler'],null)}}
    <br>
    {{ Form::submit('Update Data')}}
    {{ Link_to('kelas','Kembali')}}
    {{ Form::close()}}
@endsection