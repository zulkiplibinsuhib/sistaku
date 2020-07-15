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
        <tr><td> Kode Kelas <td>{{ Form::text('kode',null,['placeholder'=>'Kode kelas'])}}</td> </td></tr>
        <br>
        Program Studi : {{ Form::text('prodi',null,['placeholder'=>'program studi'])}}
        <br>
        Semester : {{ Form::number('semester',null,['placeholder'=>'semester'])}}
        <br>
        Jumlah Mahasiswa : {{ Form::number('mhs',null,['placeholder'=>'jumlah mahasiswa'])}}
        <br>
        Keterangan : {{ Form::select('keterangan',['karyawan'=>'karyawan','reguler'=>'reguler'],null)}}
        <br>
        
        <tr><td></td><td> 
            {{ Form::submit('Update Data')}}
            {{ Link_to('kelas','Kembali')}}
            {{ Form::close()}} 
        </td></tr>
    </table>
@endsection