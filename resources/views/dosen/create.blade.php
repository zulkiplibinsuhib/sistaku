@extends('layout')
@section('title','Input Produk')
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
 
    {{ Form::open(['url'=>'dosen'])}}
    <table class="table table-bordered">
       
        <tr><td>Nama Dosen</td><td>{{ Form::text('name',null,['placeholder'=>'Enter Nama Dosen ','class'=>'form-control'])}}</td></tr>
        <tr><td>NIDN</td><td>{{ Form::number('nidn',null,['placeholder'=>'Enter NIDN','class'=>'form-control col-md-4'])}}</td></tr>
        <tr><td>Jenis Kelamin </td><td>{{ Form::select('jenis_kelamin',['Laki-Laki'=>'Laki-Laki','Perempuan'=>'Perempuan'],null,['class'=>'form-control col-md-4'])}}</td></tr>
        <tr><td>Status </td><td>{{ Form::select('status',['Tetap'=>'Tetap','Tidak Tetap'=>'Tidak Tetap'],null,['class'=>'form-control col-md-4'])}}</td></tr>
        <tr><td>Bidang </td><td>{{ Form::select('bidang',['Produktif'=>'Produktif','MKDU'=>'MKDU'],null,['class'=>'form-control col-md-4'])}}</td></tr>
        @if(empty(Auth::user()->prodi))
        <tr><td><label for="prodi">Prodi</label></td><td><select name="prodi" class="form-control col-md-4">
                <option selected disabled>Pilih Prodi</option>
                <option value="all">All Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach 
            </select></td></tr>
        @endif
        <tr><td></td><td>    {{ Form::submit('Simpan Data',['class'=>'btn btn-success'])}}
                {{ Link_to('dosen','Kembali',['class'=>'btn btn-danger'])}}
                {{ Form::close()}}</td></tr>
    </table> 
@endsection