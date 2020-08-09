@extends('layout')
@section('title','Input Kelas')
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

    {{ Form::open(['url'=>'kelas'])}}
    <table class="table table-bordered"> 
       
        <tr><td>Kode Kelas</td><td>{{ Form::text('kode',null,['placeholder'=>'masukan kode kelas ','class'=>'form-control col-md-4','required'])}}</td></tr>
        @if(empty(Auth::user()->prodi))
        <tr><td><label for="prodi">Prodi</label></td><td><select class="form-control col-md-4" name="prodi" >
                <option selected disabled>Pilih Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
            </select></td></tr>
        @endif
        <tr><td>Nama Kelas</td><td>{{ Form::text('kelas',null,['placeholder'=>'masukan nama kelas ','class'=>'form-control ','required'])}}</td></tr>
        <tr><td>Semester </td><td>{{ Form::number('semester',null,['placeholder'=>'masukkan semester','class'=>'form-control col-md-4','required'])}}</td></tr>
        <tr><td>Tahun Akademik </td><td>{{ Form::number('tahun',null,['placeholder'=>'masukkan tahun akademik','class'=>'form-control col-md-4','required'])}}</td></tr>
        <tr><td>Jumlah Mahasiswa </td><td>{{ Form::number('mhs',null,['placeholder'=>'masukkan jumlah mahasiswa','class'=>'form-control col-md-4','required'])}}</td></tr>
        <tr><td>Keterangan </td><td>{{ Form::select('keterangan',['reguler'=>'Reguler','karyawan'=>'Karyawan'],null,['class'=>'form-control col-md-4','required'])}}</td></tr>
        <tr><td></td><td>    {{ Form::submit('Simpan Data',['class'=>'btn btn-success'])}}
                {{ Link_to('kelas','Kembali',['class'=>'btn btn-danger'])}}
                {{ Form::close()}}</td></tr>
    </table>



@endsection