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

    {{ Form::model($matkul,['url'=>'matkul/'.$matkul->id,'method'=>'put'])}}
    Kode Mata Kuliah : {{ Form::text('kode_matkul',null,['placeholder'=>'Kode Matkul'])}}
    <br>
    Mata Kuliah : {{ Form::text('matkul',null,['placeholder'=>'mata kuliah'])}}
    <br>
    SKS : {{ Form::number('sks',null,['placeholder'=>'sks'])}}
    <br>
    Kurikulum : {{ Form::select('kurikulum',['2015'=>'2015','2016'=>'2016','2017'=>'2017'],null)}}
    <br>
    <tr><td><label for="prodi">Prodi</label></td><td><select name="prodi" id="prodi">
                @foreach($data_prodi as $prodi)
                <option value="{{ $prodi}}">{{ $prodi}}</option>
                @endforeach
            </select></td></tr>
    {{ Form::submit('Update Data')}}
    {{ Link_to('matkul','Kembali')}}
    {{ Form::close()}}
@endsection