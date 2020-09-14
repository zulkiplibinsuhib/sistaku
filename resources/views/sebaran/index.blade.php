@extends('layout')
@section('title','Sebaran Politeknik TEDC Bandung')
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
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>Daftar Sebaran
                    </h3>
                    <div class="card-tools ">
                        <form class="form-inline" action="" method="get">
                            @if(Auth::user()->level == 'admin')
                            <select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                <option selected disabled>Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select>
                            @endif
                            <select name="tahun" class="custom-select my-1 mr-sm-2 " 
                                id="inlineFormCustomSelectPref">
                                <option selected disabled>Tahun Akademik</option>
                                @foreach($cari_tahun as $tahun)
                                <option value="{{$tahun->tahun_akademik}}">{{$tahun->tahun_akademik}}</option>
                                @endforeach
                            </select>
                            <select name="semester" class="custom-select my-1 mr-sm-2 " 
                                id="inlineFormCustomSelectPref">
                                <option selected disabled>Semester</option>
                                @foreach($cari_semester as $semester)
                                <option value="{{$semester->semester}}">{{$semester->semester}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary my-1 ">Filter</button>
                        </form>
                    </div>
                </div>
               
                <div class="card-body table-responsive">
                 @if(Auth::user()->level == 'prodi')
                    <form action="/sebaran/export_excel/prodi" autocomplete="off" class="form-inline input-daterange">
                        <div class="form-group mx-sm-1 mb-2">
                            
                            <button type="submit" name="cetak" id="cetak" class="btn btn-info ml-1"><i class="fa fa-print"></i> Cetak Sebaran</a>
                        </div>
                    </form>
                    @endif
                    @if(Auth::user()->level == 'admin')
                    <form action="/sebaran/export_excel" autocomplete="off" class="form-inline input-daterange">
                        <div class="form-group mb-2">
                        <select name="pilih_prodi" class="custom-select my-1 mr-sm-2" style="width: 200px;" id="inlineFormCustomSelectPref">
                                <option selected disabled>Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mx-sm-1 mb-2">
                            <div>
                            </div>
                            <button type="submit" name="cetak" id="cetak" class="btn btn-info ml-1"><i class="fa fa-print"></i> Cetak Sebaran</a>
                        </div>
                    </form>
                    @endif
                    <table class="sebaran table table-bordered table table-striped" id="sebaran">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode Kelas</th>
                                <th>Kelas</th>
                                <th>Prodi</th>
                                <th>Tahun Akademik</th>
                                <th>Semester</th>
                                <th>Mhs</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Teori</th>
                                <th>Praktek</th>
                                <th>Jam</th>
                                <th>Dosen Mengajar</th>
                                <th>Dosen PDPT</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                            @foreach ($sebaran as $row)
                            
                            <tr class="text-center">
                                <td>{{ $no++}} </td>
                                <td>{{empty($row->kode) ? 'Belum Memilih Kelas' : $row->kode}}</td> 
                                <td>{{empty($row->kelas) ? 'Belum Memilih Kelas' : $row->kelas}}</td>
                                <td>{{ $row->nama_prodi}}</td>
                                <td>{{ $row->tahun_akademik}}</td>
                                <td>{{ $row->semester}}</td>
                                <td>{{empty($row->kode) ? '0' : $row->mhs}}</td>
                                <td>{{ $row->matkul}}</td>
                                <td>{{ $row->sks}}</td>
                                <td>{{ $row->teori}}</td>
                                <td>{{ $row->praktek}}</td>
                                <td>{{ $row->jam_minggu}}</td>
                                <td>{{empty($row->name) ? 'Belum Memilih Dosen' : $row->name}}</td>
                                <td>{{empty($row->dosen_pdpt) ? 'Belum Memilih Dosen' : $row->dosen_pdpt}}</td>
                                <td>{!! $row->approved ? '<span class="badge bg-primary" >Approved</span>' : '<span class="badge bg-danger">Pending</span>'!!}</td>
                               
                                <td>
                                    <div class="d-flex justify-content-center">
                                        @if(!$row->approved)
                                        <a href="{{ route('sebaran.edit',$row->id_sebaran) }}" 
                                            class="btn btn-sm btn-warning fas fa-edit mr-2" title="Edit"></a>
                                        @endif
                                        @if(Auth::user()->level == 'admin')
                                        <form action="{{route('sebaran.destroy',$row->id_sebaran)}}" method="post"
                                            title="Hapus">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger btn-sm fas fa-trash-alt mr-2 "
                                                onclick="return confirm('Yakin mau menghapus data ini ?')"
                                                type="submit"></button>
                                        </form>
                                        @if(!$row->approved)
                                        <a href="{{route('sebaran.approve',$row->id_sebaran)}}" class="" title="Konfirmasi"
                                            type="submit"><img src="{{ asset('icons/check.png')}} " width="30px"
                                                height="30px" alt=""> </a>
                                    </div>
                                </td>
                                @endif
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('home') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection
