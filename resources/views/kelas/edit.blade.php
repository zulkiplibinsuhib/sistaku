@extends('layout')
@section('title','SISTAKU')
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
                        <label class="col-md-4 col-form-label">Kode Kelas</label>
                        {{ Form::text('kode',null,['placeholder'=>'Kode kelas','class'=>'form-control col-md-3','required'])}}
                </div>
                <div class="form-group row">
                    <label for="kelas" class="col-sm-4 col-form-label">Nama Kelas</label>
                    {{ Form::text('kelas',null,['placeholder'=>'Nama Kelas','class'=>'form-control col-md-3','required'])}}

                </div>

                {{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control col-md-7','name'=>'prodi',' readonly'])}}
                <div class="form-group row">
                    <label for="semester" class="col-md-4 col-form-label">Semester</label>
                    <div class="form-group col-md ">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="semester" value="1"
                                class="custom-control-input" name="semester">
                            <label class="custom-control-label" for="customRadioInline1">1</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="semester" value="2"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">2</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" name="semester" value="3"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline3">3</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline4" name="semester" value="4"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline4">4</label>
                        </div> <br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline5" name="semester" value="5"
                                class="custom-control-input" name="semester">
                            <label class="custom-control-label" for="customRadioInline5">5</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline6" name="semester" value="6"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline6">6</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline7" name="semester" value="7"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline7">7</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline8" name="semester" value="8"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline8">8</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-md-4 col-form-label">Tahun Ajaran</label>
                    {{ Form::number('tahun',null,['placeholder'=>'Masukkan tahun akademik','class'=>'form-control col-md-3','required'])}}
                </div>

                <div class="form-group row">
                    <label for="mhs" class="col-md-4 col-form-label">Jumlah Mahasiswa</label>
                    {{ Form::number('mhs',null,['placeholder'=>'jumlah mahasiswa','class'=>'form-control col-md-3','required'])}}
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-md-4 col-form-label">Keterangan</label>
                    {{ Form::select('keterangan',['Reguler'=>'Reguler','Karyawan'=>'Karyawan'],null,['class'=>'form-control col-md-3','required'])}}
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
