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
    <table class="table table-bordered">

        <tr><td><label for="kd_kelas">Kode Kelas</label></td><td><select name="kd_kelas" id="kd_kelas" class="form-control col-md-4">
                        @foreach($data_kode as $kode)
                        <option value="{{ $kode}}">{{ $kode}}</option>
                        @endforeach
                    </select></td></tr>
           <tr><td><label for="kelas">Kelas</label></td><td><select name="kelas" id="kelas" class="form-control col-md-4">
                        @foreach($data_kelas as $kelas)
                        <option value="{{ $kelas}}">{{ $kelas}}</option>
                        @endforeach
                    </select></td></tr>
            @if(empty(Auth::user()->prodi))
            <tr><td><label for="prodi">Prodi</label></td><td><select class="form-control col-md-4" name="prodi" id="prodi">
                    <option selected>Pilih Prodi</option>
                                    @foreach(App\Prodi::all() as $prodi)
                                    <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                    @endforeach
                </select></td></tr>
            @endif
            <tr><td>Semester <td>{{ Form::number('semester',null,['placeholder'=>'masukkan semester','class'=>'form-control col-md-4','required'])}}</td></td></tr>
            <tr><td> Mahasiswa <td> {{ Form::number('mhs',null,['placeholder'=>'Jumlah Mahasiswa ','class'=>'form-control col-md-4','required'])}}</td></td></tr>
            <tr><td><label for="matkul">Mata Kuliah</label></td><td><select name="mata_kuliah" id="matkul" class="form-control col-md-4">
                        @foreach($data_matkul as $matkul)
                        <option value="{{ $matkul}}">{{ $matkul}}</option>
                        @endforeach
                    </select></td></tr>
            <tr><td>SKS <td>{{ Form::number('sks',null,['placeholder'=>'Jumlah SKS','class'=>'form-control col-md-4','required'])}}</td></td></tr>
            <tr><td>Jam <td>{{ Form::number('jam',null,['placeholder'=>'Jumlah Jam Mengajar','class'=>'form-control col-md-4','required'])}}</td></td></tr>
            <tr><td><label for="dosen">Dosen Mengajar</label></td><td><select class="form-control col-md-4" name="dosen_mengajar" id="dosen">
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen->id}}">{{ $dosen->name}}</option>
                @endforeach
            </select></td></tr>
            <tr><td></td><td>  
            {{ Form::submit('Update Data',['class'=>'btn btn-success'])}}
            {{ Link_to('sebaran','Kembali',['class'=>'btn btn-danger'])}}
            {{ Form::close()}}
            </td></tr>
    </table>
@endsection