@extends('layout')
@section('title','SISTAKU')
@section('content')
<section class="content">

        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline text-sm-3">
                    <div class="card-header">
                        <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>Daftar Kelas
                        </h3>
                        <div class="card-tools ">
                        <form class="form-inline" action="" method="get">
                            @if(Auth::user()->level == 'admin')
                            <select name="prodi" class="custom-select my-1 mr-sm-2" style="width: 200px;" id="inlineFormCustomSelectPref">
                                <option selected disabled>Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select>
                            @endif
                            <select name="tahun" class="custom-select my-1 mr-sm-2" style="width: 200px;" id="inlineFormCustomSelectPref">
                                <option selected disabled>Tahun Akademik</option>
                                @foreach($cari_tahun as $matkul)
                                <option value="{{$matkul->tahun}}">{{$matkul->tahun}}</option>
                                @endforeach

                            </select>
                            <select name="semester" class="custom-select my-1 mr-sm-2 col-md-2"
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
                        <table class="table table-bordered " id="kelas">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th> Kode Kelas</th>
                                    <th>Prodi</th>
                                    <th>Semester</th>
                                    <th>Mhs</th>
                                    <th>Tahun Akademik</th>
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
                                    <td>{{ $row->nama}}</td>
                                    <td>{{ $row->semester}}</td>
                                    <td>{{ $row->mhs}}</td>
                                    <td>{{ $row->tahun}}</td>
                                    <td>{{ $row->keterangan}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('kelas.edit',$row->id) }}" title="Edit"
                                                class="btn btn-sm btn-warning fas fa-edit mr-2" ></a>
                                            <form action="{{route('kelas.destroy',$row->id)}}" method="post"
                                                title="Hapus">
                                                @csrf
                                                @method('Delete')
                                                <button class="btn btn-danger btn-sm fas fa-trash-alt "
                                                    onclick="return confirm('Yakin Mau di Hapus ?')"
                                                    type="submit"></button>
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






@endsection()
