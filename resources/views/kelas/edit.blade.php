@extends('layout')
@section('title','Sistem Informasi Penentuan Dosen Pengampu Mata Kuliah')
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
<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline text-sm-3">
            <div class="card-header">
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Kelas
                </h3>
            </div>
            <div class="card-body">
                
                {{ Form::model($kelas,['url'=>'kelas/'.$kelas->id,'method'=>'put'])}}
                <div class="form-group row">
                <form class="form-horizontal">
                    <label class="col-sm-2 col-form-label">Kode Kelas</label>
                    {{ Form::text('kode',null,['placeholder'=>'Kode kelas','class'=>'form-control col-md-2','required'])}}
                </div>
                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                    {{ Form::text('kelas',null,['placeholder'=>'Nama Kelas','class'=>'form-control col-md-2','required'])}}

                </div>

                {{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control col-md-4','name'=>'prodi',' readonly'])}}
                <div class="form-group row">
                    <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                    <div class="form-group col-md-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="semester1" checked>1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="semester2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio3" value="3">
                            <label class="form-check-label" for="semester3">3 </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio3" value="4">
                            <label class="form-check-label" for="semester4">4 </label>
                        </div>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio3" value="5">
                            <label class="form-check-label" for="semester5">5 </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio3" value="6">
                            <label class="form-check-label" for="semester6">6 </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio3" value="7">
                            <label class="form-check-label" for="semester7">7 </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio3" value="8">
                            <label class="form-check-label" for="semester8">8 </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                    {{ Form::number('tahun',null,['placeholder'=>'Masukkan tahun akademik','class'=>'form-control col-md-2','required'])}}
                </div>

                <div class="form-group row">
                    <label for="mhs" class="col-sm-2 col-form-label">Jumlah Mahasiswa</label>
                    {{ Form::number('mhs',null,['placeholder'=>'jumlah mahasiswa','class'=>'form-control col-md-2','required'])}}
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    {{ Form::select('keterangan',['Reguler'=>'Reguler','Karyawan'=>'Karyawan'],null,['class'=>'form-control col-md-2'])}}
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                    <a href="{{ route('kelas.index')}}" class="btn btn-default float-right">Cancel</a>
                </div>
                {{ Form::close()}}
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
