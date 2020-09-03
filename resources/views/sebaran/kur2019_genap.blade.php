@extends('layout')
@section('title','Input Sebaran')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
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
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline text-sm-3">
                <div class="card-header">
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>Input Sebaran
                    </h3>
                    <div class="card-tools ">
                        <p class="text-bold">Kurikulum 2019</p>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    {{ Form::open(['url'=>'sebaran'])}}
                    <table class="sebaran-table table table-bordered table table-striped" id="sebaran-table">
                        <h4 class="text-center">Semester 2</h4>
                        <thead>
                            <tr class="text-center">
                                <th>Mata Kuliah</th>
                                <th>Kode Kelas</th>
                                <th>Tahun Akademik</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                            </tr>
                        </thead>
                            @foreach ($semester2 as $row2)
                            <tr class="text-center">
                                <td>{{$row2->matkul}} </td>
                                <input type="hidden" name="mata_kuliah[]" value="{{$row2->id}}">
                                <td><select name="kd_kelas[]" id="" class="form-control">
                                    <option disabled selected>Pilih Kode Kelas</option>
                                    @foreach(App\Kelas::all() as $row)
                                    <option value="{{$row->id}}">{{$row->kode}}</option>
                                    @endforeach
                                </select> </td>
                                <input type="hidden" name="semester[]" value="{{$row2->semester}}">
                                <input type="hidden" name="prodi[]" value="{{$row2->prodi}}">
                                <td> <Input class="form-control" name="tahun_akademik[]" placeholder="Ex.2019/2020"></Input> </td>
                                <td><select name="dosen_mengajar[]" id="" class="form-control">
                                    <option selected value="Belum Memilih Dosen">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                                <td><select name="dosen_pdpt[]" id="" class="form-control">
                                    <option  selected value="Belum Memilih Dosen">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                            @endforeach
                        <tbody >
                            
                        </tbody>
                    </table>
                    <div>
                        <button>Tambah Tabel</button>
                    </div>
                    
                    <hr><br>

                    <table class="sebaran-table table table-bordered table table-striped" id="sebaran-table">
                        <h4 class="text-center">Semester 4</h4>
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Kode Kelas</th>
                                <th>Tahun Akademik</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                            </tr>
                        </thead>
                            @foreach ($semester4 as $row4)
                            <tr class="text-center">
                                <td>{{$row4->matkul}} </td>
                                <input type="hidden" name="mata_kuliah[]" value="{{$row4->id}}">
                                <td><select name="kd_kelas[]" id="" class="form-control">
                                    <option disabled selected>Pilih Kode Kelas</option>
                                    @foreach(App\Kelas::all() as $row)
                                    <option value="{{$row->id}}">{{$row->kode}}</option>
                                    @endforeach
                                </select> </td>
                                <input type="hidden" name="semester[]" value="{{$row4->semester}}">
                                <input type="hidden" name="prodi[]" value="{{$row4->prodi}}">
                                <td> <Input class="form-control" name="tahun_akademik[]" placeholder="Ex.2019/2020"></Input> </td>
                                <td><select name="dosen_mengajar[]" id="" class="form-control">
                                    <option selected value="Belum Memilih Dosen">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                                <td><select name="dosen_pdpt[]" id="" class="form-control">
                                    <option selected value="Belum Memilih Dosen">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                            @endforeach
                        <tbody >
                            
                        </tbody>
                    </table>
                    <div>
                        <button>Tambah Tabel</button>
                    </div>
                    
                    <hr><br>

                    <table class="sebaran-table table table-bordered table table-striped" id="sebaran-table">
                        <h4 class="text-center">Semester 6</h4>
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Kode Kelas</th>
                                <th>Tahun Akademik</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                            </tr>
                        </thead>
                            @foreach ($semester6 as $row6)
                            <tr class="text-center">
                                <td>{{$row6->matkul}} </td>
                                <input type="hidden" name="mata_kuliah[]" value="{{$row6->id}}">
                                <td><select name="kd_kelas[]" id="" class="form-control">
                                    <option disabled selected>Pilih Kode Kelas</option>
                                    @foreach(App\Kelas::all() as $row)
                                    <option value="{{$row->id}}">{{$row->kode}}</option>
                                    @endforeach
                                </select> </td>
                                <input type="hidden" name="semester[]" value="{{$row6->semester}}">
                                <input type="hidden" name="prodi[]" value="{{$row6->prodi}}">
                                <td> <Input class="form-control" name="tahun_akademik[]" placeholder="Ex.2019/2020"></Input> </td>
                                <td><select name="dosen_mengajar[]" id="" class="form-control">
                                    <option selected value="Belum Memilih Dosen">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                                <td><select name="dosen_pdpt[]" id="" class="form-control">
                                    <option selected value="Belum Memilih Dosen">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                            @endforeach
                        <tbody >
                            
                        </tbody>
                    </table>
                    <div>
                        <button>Tambah Tabel</button>
                    </div>
                    
                    <hr><br>

                    <table class="sebaran-table table table-bordered table table-striped" id="sebaran-table">
                        <h4 class="text-center">Semester 8</h4>
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Kode Kelas</th>
                                <th>Tahun Akademik</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                            </tr>
                        </thead>
                            @foreach ($semester8 as $row8)
                            <tr class="text-center">
                                <td>{{$row8->matkul}} </td>
                                <input type="hidden" name="mata_kuliah[]" value="{{$row8->id}}">
                                <td><select name="kd_kelas[]" id="" class="form-control">
                                    <option disabled selected>Pilih Kode Kelas</option>
                                    @foreach(App\Kelas::all() as $row)
                                    <option value="{{$row->id}}">{{$row->kode}}</option>
                                    @endforeach
                                </select> </td>
                                <input type="hidden" name="semester[]" value="{{$row8->semester}}">
                                <input type="hidden" name="prodi[]" value="{{$row8->prodi}}">
                                <td> <Input class="form-control" name="tahun_akademik[]" placeholder="Ex.2019/2020"></Input> </td>
                                <td><select name="dosen_mengajar[]" id="" class="form-control">
                                    <option selected value="Belum Memilih Dosen">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                                <td><select name="dosen_pdpt[]" id="" class="form-control">
                                    <option selected value="Belum Memilih Dosen">Pilih Dosen</option>
                                    @foreach($data_dosen as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                            @endforeach
                        <tbody >
                            
                        </tbody>
                    </table>
                    <div>
                        <button>Tambah Tabel</button>
                    </div>
                    
                    <hr><br>


                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right">Input</button>
                        <a href="{{ route('sebaran.index')}}" class="btn btn-default ">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection