@extends('layout')
@section('title','Daftar Mata Kuliah')
@section('content')


<form class="form-inline" action="" method="get">
@if(Auth::user()->level == 'admin')
    <select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $prodi)
        <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
        @endforeach
    </select>
    @endif
    <select name="tahun" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Tahun Akademik</option>
        @foreach($cari_tahun as $matkul)
        <option value="{{$matkul->tahun}}">{{$matkul->tahun}}</option>
        @endforeach
     
    </select>
    <select name="semester" class="custom-select my-1 mr-sm-2 col-md-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Semester</option>
        @foreach($cari_semester as $semester)
        <option value="{{$semester->semester}}">{{$semester->semester}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary my-1 ">Cari</button>
</form>
<table class="table table-bordered" id="matkul">
    <thead>
        <tr class="text-center">
            <th>Kode</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Kurikulum</th>
            <th>Semester</th>
            <th>Tahun Akademik</th>
            <!-- <th>Prodi</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($get_ProdiAndMatkul as $row)
        <tr class="text-center">
            <td>{{ $row->kode_matkul}}</td>
            <td>{{ $row->matkul}}</td>
            <td>{{ $row->sks}}</td>
            <td>{{ $row->kurikulum}}</td>
            <td>{{ $row->semester}}</td>
            <td>{{ $row->tahun}}</td>
            <!-- <td>{{ $row->nama}}</td> -->
            <td> <div class="d-flex justify-content-center">
                <a href="{{ route('matkul.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit mr-2" title="Edit" ></a>
                <form action="{{route('matkul.destroy',$row->id)}}" method="post" title="Hapus">
                    @csrf
                    @method('Delete')
                    <button class="btn btn-danger btn-sm fas fa-trash-alt" data-id="{{$row->id}}"  id="hapus" onclick="return confirm('Yakin Mau di Hapus ?')"
                        type="submit"></button>
                </form>
                </div>
                </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('matkul.create') }}" class="btn btn-success ">Tambah Data</a>
<a href="{{ route('home') }}" class="btn btn-danger ">Kembali</a>


@endsection()

