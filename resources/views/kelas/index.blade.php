@extends('layout')
@section('title','Daftar Kelas')
@section('content')
<form class="form-inline" action="" method="get">
    <select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $prodi)
        <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary my-1 ">Cari</button>
</form>
<table class="table table-bordered" id="kelas">
    <thead>
        <tr class="text-center">
            <th> Kode Kelas</th>
            <th>Prodi</th>
            <th>Semester</th>
            <th>Mhs</th>
            <th>keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($get_prodiAndKelas as $row)
        <tr class="text-center">
            <td>{{ $row->kode}}</td>
            <td>{{ $row->nama}}</td>
            <td>{{ $row->semester}}</td>
            <td>{{ $row->mhs}}</td>
            <td>{{ $row->keterangan}}</td>
            <td><div class="d-flex">
                <a href="{{ route('kelas.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit mr-2" ></a>
                <form action="{{route('kelas.destroy',$row->id)}}" method="post" title="Hapus">
                    @csrf
                    @method('Delete')
                    <button class="btn btn-danger btn-sm fas fa-trash-alt " onclick="return confirm('Yakin Mau di Hapus ?')"
                        type="submit"></button>
                </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('kelas.create') }}" class="btn btn-success  ">Tambah Data</a>
<a href="{{ route('home') }}" class="btn btn-danger">Kembali</a>
@endsection()
