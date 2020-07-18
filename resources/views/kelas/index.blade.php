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
  <button type="submit" class="btn btn-primary my-1 btn-sm">Search</button>
</form>
<table class="table table-bordered">
        <tr><th>Kode Kelas</th><th>Prodi</th><th>Semester</th><th>Mhs</th><th>keterangan</th><th colspan="2">Action</th></tr>
        @foreach ($get_prodiAndKelas as $row)
            <tr><td>{{ $row->kode}}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ $row->semester}}</td>
                <td>{{ $row->mhs}}</td>
                <td>{{ $row->keterangan}}</td>
                <td><a href="{{ route('kelas.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit "></a><td>
                    <form action="{{route('kelas.destroy',$row->id)}}" method="post">
                            @csrf
                            @method('Delete')
                            <button class="btn btn-danger btn-sm fas fa-trash-alt " onclick="return confirm('Yakin Mau di Hapus ?')" type="submit"></button>
                        </form>
                </td>


            </tr>
        @endforeach
    </table>
<a href="{{ route('kelas.create') }}" class="btn btn-success  ">Tambah Data</a>
<a href="{{ route('home') }}" class="btn btn-danger  ">Kembali</a>
@endsection()