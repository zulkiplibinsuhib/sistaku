@extends('layout')
@section('title','Daftar Mata Kuliah')
@section('content')


<form class="form-inline" action="" method="get">
    <select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $prodi)
        <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
        @endforeach
    </select>
    <select name="kurikulum" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Kurikulum</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
    </select>
    <button type="submit" class="btn btn-primary my-1 btn-sm">Search</button>
</form>
<table class="table table-bordered" id="matkul">
    <thead>
        <tr class="text-center">
            <th>Kode</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>>Kurikulum</th>
            <th>Semester</th>
            <th>Prodi</th>
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
            <td>{{ $row->nama}}</td>
            <td> <a href="{{ route('matkul.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit "></a>
                <form action="{{route('matkul.destroy',$row->id)}}" method="post">
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
<a href="{{ route('matkul.create') }}" class="btn btn-success ">Tambah Data</a>
<a href="{{ route('home') }}" class="btn btn-danger ">Kembali</a>


@endsection()

