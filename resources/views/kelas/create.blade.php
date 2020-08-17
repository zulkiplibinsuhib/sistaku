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

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show col-4" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
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
                        <label for="kode" class="offset-1 col-3 col-form-label">Kode Kelas</label>
                        <div class="col-6">
                            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Kelas"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kelas" class=" offset-1 col-3 col-form-label">Nama Kelas</label>
                        <div class="col-6">
                            <input type="text" class="form-control " name="kelas" placeholder="Nama Kelas" required>
                        </div>
                    </div>
                    @if(empty(Auth::user()->prodi))
                    <div class="form-group row">
                        <label for="inputPassword3" class="offset-1 col-3 col-form-label">Program Studi</label>
                        <div class="col-6">
                            <select class="form-control " name="prodi" required>
                                <option selected disabled>Pilih Program Studi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select></td>
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label for="semester" class="offset-1 col-3 col-form-label">Semester</label>
                        <div class="form-group col-6">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="semester" value="1"
                                    class="custom-control-input" name="semester">
                                <label class="custom-control-label" for="customRadioInline1">1</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="semester" value="2"
                                    class="custom-control-input ">
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
                            </div>
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
                        <label for="tahun" class="offset-1 col-3 col-form-label">Tahun Ajaran</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="tahun" placeholder="Tahun Ajaran" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mhs" class="offset-1 col-3 col-form-label">Jumlah Mahasiswa</label>
                        <div class="col-6">
                            <input type="number" class="form-control" name="mhs" placeholder="Jumlah Mahasiswa"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="offset-1 col-3 col-form-label">Keterangan</label>
                        <div class="col-6">
                            <select name="keterangan" class="form-control ">
                                <option value="Reguler">Reguler</option>
                                <option value="karyawan">Karyawan</option>
                            </select>
                        </div>
                    </div>


                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">Input</button>
                        <a href="{{ route('kelas.index')}}" class="btn btn-default ">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
                {{ Form::close()}}
            </div>
        </div>
    </div>
</div>



@endsection
