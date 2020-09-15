@extends('layout')
@section('title','Kelas')
@section('content')

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
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>List Kelas
                    </h3>
                    <div class="card-tools ">
                        <form class="form-inline" action="" method="get">
                            @if(Auth::user()->level == 'admin')
                            <select name="prodi" class="custom-select my-1 mr-sm-2" style="width: 200px;"
                                id="inlineFormCustomSelectPref">
                                <option selected disabled>Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select>
                            @endif
                            <select name="tahun" class="custom-select my-1 mr-sm-2" style="width: 200px;"
                                id="inlineFormCustomSelectPref">
                                <option selected disabled>Tahun Akademik</option>
                                @foreach($cari_tahun as $matkul)
                                <option value="{{$matkul->tahun}}">{{$matkul->tahun}}</option>
                                @endforeach

                            </select>
                            <select name="semester" class="custom-select my-1 mr-sm-2  " style="width: 150px;"
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
                    <table class="table table-bordered table-striped " id="kelas">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode Kelas</th>
                                <th>Kelas</th>
                                @if(empty(Auth::user()->prodi))
                                <th>Prodi</th>
                                @endif
                                <th>Semester</th>
                                <th>Mahasiswa</th>
                                <th>Angkatan</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ; ?>
                            @foreach ($get_prodiAndKelas as $row)
                            <tr class="text-center">
                                <td>{{ $no++}} </td>
                                <td>{{ $row->kode}}</td>
                                <td>{{ $row->kelas}}</td>
                                @if(empty(Auth::user()->prodi))
                                <td>{{ $row->nama}}</td>
                                @endif
                                <td>{{ $row->semester}}</td>
                                <td>{{ $row->mhs}}</td>
                                <td>{{ $row->tahun}}</td>
                                <td>{{ $row->keterangan}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('kelas.edit',$row->id) }}" title="Edit"
                                            class="btn btn-sm btn-warning fas fa-edit mr-2"></a>
                                        <form action="{{route('kelas.destroy',$row->id)}}" method="post" title="Hapus">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger btn-sm fas fa-trash-alt mr-2 "
                                                onclick="return confirm('Yakin Mau di Hapus ?')" type="submit"></button>
                                        </form>
                                    </div>
                                </td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
        $(document).ready(function () {
            $('#kelas ').DataTable({
                order: [
                [3, 'asc']
            ],
            rowGroup: {
                dataSrc: 3
            }
            });
        });

    </script>
@endsection()
