@extends('layout')
@section('title','Update Sebaran ')
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

    {{ Form::model($sebaran,['url'=>'sebaran/'.$sebaran->id,'method'=>'put'])}}
    
   <tr><td><label for="kd_kelas">Kode Kelas</label></td><td><select name="kd_kelas" id="kd_kelas">
                @foreach($data_kode as $kode)
                <option value="{{ $kode}}">{{ $kode}}</option>
                @endforeach
            </select></td></tr>
    <br>
    <tr><td><label for="kelas">Kelas</label></td><td><select name="kelas" id="kelas">
                @foreach($data_kelas as $kelas)
                <option value="{{ $kelas}}">{{ $kelas}}</option>
                @endforeach
            </select></td></tr>
    <br>
    <tr><td><label for="prodi">Prodi</label></td><td><select name="prodi" id="prodi">
                @foreach($data_prodi as $prodi)
                <option value="{{ $prodi}}">{{ $prodi}}</option>
                @endforeach
            </select></td></tr>
    <br>
    Semester : {{ Form::number('semester',null,['placeholder'=>'masukkan semester'])}}
    <br>
    Mahasiswa : {{ Form::number('mhs',null,['placeholder'=>'Jumlah Mahasiswa '])}}
    <br>
    <tr><td><label for="matkul">Mata Kuliah</label></td><td><select name="mata_kuliah" id="matkul">
                @foreach($data_matkul as $matkul)
                <option value="{{ $matkul}}">{{ $matkul}}</option>
                @endforeach
            </select></td></tr>
    <br>
    SKS{{ Form::number('sks',null,['placeholder'=>'Jumlah SKS'])}}
    <br>
    Jam{{ Form::number('jam',null,['placeholder'=>'Jumlah Jam Mengajar'])}}
    <br>
    <tr><td><label for="dosen">Dosen Mengajar</label></td><td><select name="dosen_mengajar" id="dosen">
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen}}">{{ $dosen}}</option>
                @endforeach
            </select></td></tr>
    <br>

    {{ Form::submit('Update Data')}}
    {{ Link_to('sebaran','Kembali')}}
    {{ Form::close()}}
@endsection