@extends('layout')
@section('title','Update Data Dosen')
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

    {{ Form::model($dosen,['url'=>'dosen/'.$dosen->id,'method'=>'put'])}}
    Nama Dosen : {{ Form::text('name',null,['placeholder'=>'Nama Dosen'])}}
    <br>
    NIDN : {{ Form::number('nidn',null,['placeholder'=>'NIDN'])}}
    <br>
    Jenis Kelamin : {{ Form::select('jenis_kelamin',['Laki-Laki'=>'Laki-Laki','Perempuan'=>'Perempuan'],null)}}
    <br>
    Status : {{ Form::select('status',['aktif'=>'Aktif','Tidak Aktif'=>'Tidak Aktif'],null)}}
    <br>
    {{ Form::submit('Update Data')}}
    {{ Link_to('dosen','Kembali')}}
    {{ Form::close()}}
@endsection