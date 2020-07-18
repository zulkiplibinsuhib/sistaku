@extends('layout')
@section('title','Sebaran Politeknik TEDC Bandung')
@section('content')

 
<form class="form-inline" action="" method="get">
  <select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $prodi)
          <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
        @endforeach
  </select>
  <select name="semester" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected disabled>Semester</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
  </select>

  <button type="submit" class="btn btn-primary my-1 btn-sm">Search</button>
</form>
<table class="table table-bordered">
        <tr><th>Kode Kelas</th><th>Kelas</th><th>Prodi</th><th>Semester</th><th>Mhs</th><th>Mata Kuliah</th><th>SKS</th><th>Jam</th><th>Dosen Mengajar</th><th>Status</th>@if(Auth::user()->level == 'admin')<th colspan="3">Action</th>@endif</tr>
        @foreach ($get_prodiAndSebaran as $row)
            <tr><td>{{ $row->kd_kelas}}</td>
                <td>{{ $row->kelas}}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ $row->semester}}</td>
                <td>{{ $row->mhs}}</td>
                <td>{{ $row->mata_kuliah}}</td>
                <td>{{ $row->sks}}</td>
                <td>{{ $row->jam}}</td>
                <td>{{ $row->name}}</td>
                <td>{{ $row->approved ? 'approved' : 'not approved'}}</td>
                @if(Auth::user()->level == 'admin')
                <td>
                    <form action="{{route('sebaran.destroy',$row->id)}}" method="post">
                            @csrf
                            @method('Delete')
                            <button class="btn btn-danger btn-sm fas fa-trash-alt " onclick="return confirm('Yakin Mau di Hapus ?')" type="submit"></button>
                        </form>
                </td>
                
                
                @if(!$row->approved)
                <td><a href="{{ route('sebaran.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit "></a><td>
                <td>{{ link_to( route ('sebaran.approve', ['id' => $row->id]),'ACC',['class'=>'btn btn-success btn-sm']) }}</td>
                @endif
                @endif


            </tr>
        @endforeach
    </table>
  
    @if(Auth::user()->level == 'prodi')
<a href="{{ route('sebaran.create') }}" class="btn btn-success ">Tambah Data</a>
@endif
<a href="{{ route('home') }}" class="btn btn-danger ">Kembali</a>
    @endsection()