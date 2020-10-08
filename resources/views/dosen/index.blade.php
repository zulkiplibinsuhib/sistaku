@extends('layout')
@section('title','Dosen')
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
                    <h3 class="card-title text text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>List
                        Dosen
                    </h3>
                    <div class="card-tools mr-1 ">
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
                            <select name="bidang" class="custom-select my-1 mr-sm-2" style="width: 200px;"
                                id="inlineFormCustomSelectPref">
                                <option selected disabled>Bidang</option>
                                @foreach($cari_bidang as $dosen)
                                <option value="{{$dosen->bidang}}">{{$dosen->bidang}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary my-1 ">Filter</button>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped" id="dosen">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>NIDN</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
                                <th>Bidang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            @foreach ($get_prodiAndDosen as $row)
                            <tr class="text-center">
                                <td>{{$no++}} </td>
                                <td>{{ $row->name}}</td>
                                <td>{{ $row->nidn}}</td>
                                <td>{{ $row->jenis_kelamin}}</td>
                                <td>{{ $row->status}}</td>
                                <td>{{ $row->nama_bidang}}</td>
                                <!-- <td>{{ $row->nama}}</td> -->
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('dosen.show',$row->id) }}"
                                            class="btn btn-sm btn-info fas fa-eye mr-2" title="Detail"></a>
                                        <a href="{{ route('dosen.edit',$row->id) }}"
                                            class="btn btn-sm btn-warning fas fa-edit mr-2" title="Edit"></a>
                                        <form action="{{route('dosen.destroy',$row->id)}}" method="post" title="Hapus">
                                            @csrf
                                            @method('Delete')
                                            <button class="btn btn-danger btn-sm fas fa-trash-alt "
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
        $('#dosen ').DataTable({
            order: [
                [5, 'desc']
            ],
            rowGroup: {
                dataSrc: 5
            }
        });
        $('#show_dosen ').DataTable({});
    });

</script>

@endsection()
