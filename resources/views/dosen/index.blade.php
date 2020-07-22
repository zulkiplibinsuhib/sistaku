@extends('layout')
@section('title','Daftar Dosen')
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
<table class="table table-bordered" id="dosen">
    <thead>
        <tr class="text-center">
            <th>Nama Dosen</th>
            <th>NIDN</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
            <th>Prodi</th>
            <th>Jumlah Jam Mengajar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($get_prodiAndDosen as $row)
        <tr class="text-center">
            <td>{{ $row->name}}</td>
            <td>{{ $row->nidn}}</td>
            <td>{{ $row->jenis_kelamin}}</td>
            <td>{{ $row->status}}</td>
            <td>{{ $row->nama}}</td>
            <td>{{ $row->jumlah_jam}}</td>
            <td><a href="{{ route('dosen.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit "></a>
                <form action="{{route('dosen.destroy',$row->id)}}" method="post">
                    @csrf
                    @method('Delete')
                    <button class="btn btn-danger btn-sm fas fa-trash-alt " onclick="return confirm('Yakin Mau di Hapus ?')"
                        type="submit"></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{link_to('dosen/create','Tambah Dosen Baru',['class'=>'btn btn-success'])}}
{{ Link_to('home','Kembali',['class'=>'btn btn-danger'])}}


@endsection()
