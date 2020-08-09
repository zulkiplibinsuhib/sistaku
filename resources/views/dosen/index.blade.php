@extends('layout')
@section('title','Daftar Dosen')
@section('content')

<a class="btn btn-warning" href="{{ route('exportdosen') }}">Export</a>
<form class="form-inline" action="" method="get">
@if(Auth::user()->level == 'admin')
    <select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $prodi)
        <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
        @endforeach
    </select>
    @endif
    <select name="bidang" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Bidang</option>
        @foreach($cari_bidang as $dosen)
        <option value="{{$dosen->bidang}}">{{$dosen->bidang}}</option>
        @endforeach
    </select>
    
   
    <button type="submit" class="btn btn-primary my-1 ">Cari</button>
</form>

		
<table class="table table-bordered" id="dosen">
    <thead>
        <tr class="text-center">
            <th>Nama Dosen</th>
            <th>NIDN</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
            <th>Bidang</th>
            <!-- <th>Prodi</th> -->
            
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
            <td>{{ $row->bidang}}</td>
            <!-- <td>{{ $row->nama}}</td> -->
            
            <td><div class="d-flex justify-content-center">
                <a href="{{ route('dosen.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit mr-2" title="Edit"></a>
                <form action="{{route('dosen.destroy',$row->id)}}" method="post" title="Hapus">
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

{{link_to('dosen/create','Tambah Dosen Baru',['class'=>'btn btn-success'])}}
{{ Link_to('home','Kembali',['class'=>'btn btn-danger'])}}


@endsection()
