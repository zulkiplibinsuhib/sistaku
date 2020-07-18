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
        @if(empty(Auth::user()->prodi))
        <tr><td><label for="prodi">Prodi</label></td><td><select class="form-control col-md-4" name="prodi" id="prodi">
                <option selected>Pilih Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
            </select></td></tr>
        @endif<tr><td>Program Studi <td>{{ Form::text('prodi',null,['placeholder'=>'program studi','class'=>'form-control col-md-4','required'])}} </td> </td></tr>
        <tr><td>Jumlah Mahasiswa <td> {{ Form::number('mhs',null,['placeholder'=>'jumlah mahasiswa','class'=>'form-control col-md-4','required'])}}</td> </td></tr>
        <tr><td>Keterangan <td> {{ Form::select('keterangan',['karyawan'=>'karyawan','reguler'=>'reguler'],null,['class'=>'form-control col-md-4'])}}</td> </td></tr>
        <tr><td></td><td> 
            {{ Form::submit('Update Data',['class'=>'btn btn-success'])}}
            {{ Link_to('kelas','Kembali',['class'=>'btn btn-danger'])}}
            {{ Form::close()}} 
        </td></tr>
    </table>
@endsection