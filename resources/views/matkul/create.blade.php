@extends('layout')
@section('title','Input Mata Kuliah')
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

    {{ Form::open(['url'=>'matkul'])}} 
    <table class="table table-bordered">
       
        <tr><td>Kode Mata Kuliah</td><td>{{ Form::text('kode_matkul',null,['placeholder'=>'Enter Kode Mata Kuliah ','class'=>'form-control'])}}</td></tr>
        <tr><td>Mata Kuliah</td><td>{{ Form::text('matkul',null,['placeholder'=>'Enter Mata Kuliah','class'=>'form-control'])}}</td></tr>
        <tr><td>SKS </td><td>{{ Form::number('sks',null,['placeholder'=>'Enter SKS','class'=>'form-control col-md-4'])}}</td></tr>
        <tr><td><label for="kurikulum">Kurikulum</label></td><td>{{ Form::select('kurikulum',['2015'=>'2015','2016'=>'2016','2017'=>'2017'],null,['class'=>'form-control col-md-4'])}}</td></tr>
        <tr><td><label for="semester">Semester</label></td><td>{{  Form::number('semester',null,['placeholder'=>'Enter Semester','class'=>'form-control col-md-4'])}}</td></tr>
        @if(empty(Auth::user()->prodi))
        <tr><td><label for="prodi">Prodi</label></td><td><select name="prodi" id="prodi" class="form-control col-md-4">
                <option selected disabled>Pilih Prodi</option>
                <option value="all">All Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach 
            </select></td></tr>
        
        @endif 
        </td></tr>
        <tr><td></td><td>    {{ Form::submit('Simpan Data',['class'=>'btn btn-success'])}}
                {{ Link_to('matkul','Kembali',['class'=>'btn btn-danger'])}}
                {{ Form::close()}}</td></tr>
    </table>
@endsection


