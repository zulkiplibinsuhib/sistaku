@extends('layout')
@section('title','SISTAKU)
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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Input Kelas
                </h3>
            </div>
            <div class="card-body">
                {{ Form::open(['url'=>'kelas'])}}
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="kode" class="col-md-4 col-form-label">Kode Kelas</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Kelas"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kelas" class="col-md-4 col-form-label">Nama Kelas</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="kelas" placeholder="Nama Kelas" required>
                        </div>
                    </div>
                    @if(empty(Auth::user()->prodi))
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-md-4 col-form-label">Program Studi</label>
                        <div class="col-sm-8">
                            <select class="form-control col-md-3" name="prodi" required>
                                <option selected disabled>Pilih Program Studi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select></td>
                        </div>
                    </div>
                    @endif

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
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="tahun" placeholder="Tahun Ajaran" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mhs" class="col-md-4 col-form-label">Jumlah Mahasiswa</label>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="mhs" placeholder="Jumlah Mahasiswa"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-md-4 col-form-label">Keterangan</label>
                        <div class="col-md-8">
                            <select name="keterangan" class="form-control col-md-3">
                                <option value="Reguler">Reguler</option>
                                <option value="karyawan">Karyawan</option>
                            </select>
                        </div>
                    </div>


                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Input</button>
                        <a href="{{ route('kelas.index')}}" class="btn btn-default float-right">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
                {{ Form::close()}}
            </div>
        </div>
    </div>
</div>



@endsection
