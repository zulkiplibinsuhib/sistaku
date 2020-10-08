@extends('layout')
@section('title','Mata Kuliah')
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
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>List Mata Kuliah
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
                    <table class="table table-bordered table-striped" id="matkul">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>T</th>
                                <th>P</th>
                                <th>Jam</th>
                                <th>Kurikulum</th>
                                <th>Semester</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @foreach ($get_ProdiAndMatkul as $row)
                            <tr class="text-center">
                                <td>{{ $no++}} </td>
                                <td>{{ $row->kode_matkul}}</td>
                                <td>{{ $row->matkul}}</td>
                                <td>{{ $row->sks}}</td>
                                <td>{{ $row->teori}}</td>
                                <td>{{ $row->praktek}}</td>
                                <td>{{ $row->jam_minggu}}</td>
                                <td>{{ $row->kurikulum}}</td>
                                <td>{{ $row->semester}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('matkul.edit',$row->id) }}"
                                            class="btn btn-sm btn-warning fas fa-edit mr-2" title="Edit"></a>
                                        <form action="{{route('matkul.destroy',$row->id)}}" method="post" title="Hapus">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger btn-sm fas fa-trash-alt"
                                                data-id="{{$row->id}}" id="hapus"
                                                onclick="return confirm('Yakin Mau di Hapus ?')" type="submit"></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table><a href="{{ route('home') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#matkul').DataTable({
            order: [
                [8, 'asc']
            ],
            rowGroup: {
                dataSrc: 8
            }
        });
    });

</script>

@endsection()
