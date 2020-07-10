@extends('layout')
@section('title','Update Data Program Studi')
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

    {{ Form::model($prodi,['url'=>'prodi/'.$prodi->id,'method'=>'put'])}}
    Kode Prodi: {{ Form::text('kode',null,['placeholder'=>'Kode prodi'])}}
    <br>
    Prodi : {{ Form::text('nama',null,['placeholder'=>'Program studi'])}}
    <br>
   
    {{ Form::submit('Update Data')}}
    {{ Link_to('prodi','Kembali')}}
    {{ Form::close()}}
@endsection