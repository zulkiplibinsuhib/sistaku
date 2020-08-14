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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Input Kelas
                </h3>
            </div>
            <div class="card-body">
                {{ Form::open(['url'=>'kelas'])}}
                <form class="form-horizontal">
                        <div class="form-group row">
                            <label for="kode" class="col-sm-2 col-form-label">Kode Kelas</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Kelas"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="kelas" placeholder="Nama Kelas" required>
                            </div>
                        </div>
                        @if(empty(Auth::user()->prodi))
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Program Studi</label>
                            <div class="col-sm-10">
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
                            <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                            <div class="form-group col-md-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="semester"
                                        id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="semester1" checked>1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="semester"
                                        id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="semester2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="semester"
                                        id="inlineRadio3" value="3" >
                                    <label class="form-check-label" for="semester3">3 </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="semester"
                                        id="inlineRadio3" value="4" >
                                    <label class="form-check-label" for="semester4">4 </label>
                                </div>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="semester"
                                        id="inlineRadio3" value="5" >
                                    <label class="form-check-label" for="semester5">5 </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="semester"
                                        id="inlineRadio3" value="6" >
                                    <label class="form-check-label" for="semester6">6 </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="semester"
                                        id="inlineRadio3" value="7" >
                                    <label class="form-check-label" for="semester7">7 </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="semester"
                                        id="inlineRadio3" value="8" >
                                    <label class="form-check-label" for="semester8">8 </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tahun" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="tahun" placeholder="Tahun Ajaran"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mhs" class="col-sm-2 col-form-label">Jumlah Mahasiswa</label>
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="mhs" placeholder="Jumlah Mahasiswa"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-md-7">
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
