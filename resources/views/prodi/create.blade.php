@extends('layout')
@section('title','Input Prodi')
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

    {{ Form::open(['url'=>'prodi'])}}
    <table class="table table-bordered">
       
        <tr><td>Kode Prodi</td><td>{{ Form::text('kode',null,['placeholder'=>'masukan kode prodi ','class'=>'form-control'])}}</td></tr>
        <tr><td>Prodi</td><td>{{ Form::text('nama',null,['placeholder'=>'masukkan prodi','class'=>'form-control'])}}</td></tr>
        <tr><td></td><td>    {{ Form::submit('Simpan Data',['class'=>'btn btn-success'])}}
                {{ Link_to('prodi','Kembali',['class'=>'btn btn-danger'])}}
                {{ Form::close()}}</td></tr>
    </table>
@endsection