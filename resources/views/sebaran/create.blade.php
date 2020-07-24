@extends('layout')
@section('title','Input Sebaran')
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
<section class="content">

    {{ Form::open(['url'=>'sebaran'])}}
    <table class="table table-bordered">
       
       
        <tr><td><label for="kd_kelas">Kode Kelas</label></td><td><select class="form-control col-md-4" name="kd_kelas" id="kode">
                @foreach($data_kode as $kode)
                <option value="{{ $kode->kode}}">{{ $kode->kode}}</option>
                @endforeach
            </select></td></tr>
        <tr><td>Kelas </td><td >{{ Form::text('kelas',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'kelas','id'=>'kelas-sebaran','readonly'])}}</td></tr>
        @if(empty(Auth::user()->prodi))
        <tr><td><label for="prodi">Prodi</label></td><td><select class="form-control col-md-4" name="prodi" id="prodi-sebaran">
                <option selected disabled>Pilih Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
            </select></td></tr>
        @endif
        <tr><td>Semester </td><td >{{ Form::text('semester',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'semester','id'=>'semester-sebaran','readonly'])}}</td></tr>
        <tr><td>Mahasiswa</td><td>{{ Form::text('mhs',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'mhs','id'=>'mhs-sebaran','readonly'])}}</td></tr>
        <tr><td><label for="matkul">Mata Kuliah</label></td><td><select class="form-control col-md-4" name="mata_kuliah" id="nama">
                @foreach($data_matkul as $matkul)
                <option value="{{ $matkul->matkul}}">{{ $matkul->matkul}}</option>
                @endforeach
            </select></td></tr>
        <tr><td>SKS</td><td>{{ Form::text('sks',null,['placeholder'=>'','class'=>'form-control col-md-4','id'=>'sks','readonly'])}}</td></tr>
        <tr><td>Jam</td><td>{{ Form::number('jam',null,['placeholder'=>'Jumlah Jam Mengajar','class'=>'form-control col-md-4','id'=>'jam'])}}</td></tr>
        <tr><td><label for="dosen">Dosen Mengajar</label></td><td><select class="form-control col-md-6" name="dosen_mengajar" id="dosen-sebaran">
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen->id}}">{{ $dosen->name}}</option>
                @endforeach
            </select></td></tr>


        <tr><td></td><td>    {{ Form::submit('Simpan Data',['class'=>'btn btn-success'])}}
                {{ Link_to('sebaran','Kembali',['class'=>'btn btn-danger'])}}
                {{ Form::close()}}</td></tr>
    </table>
</section>


@endsection