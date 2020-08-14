@extends('layout')
@section('title','Sebaran Politeknik TEDC Bandung')
@section('content')
<section class="content">
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
        @foreach($cari_tahun as $sebaran)
        <option value="{{$sebaran->tahun}}">{{$sebaran->tahun}}</option>
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
<table class="sebaran table table-bordered table table-striped table-responsive" id="sebaran">
    <thead>
        <tr class="text-center">
            <th>Kode Kelas</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>Tahun Akademik</th>
            <th>Semester</th>
            <th>Mhs</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Teori</th>
            <th>Praktek</th>
            <th>Jam</th>
            <th>Dosen PDPT</th>
            <th>Dosen Mengajar</th>
            <th>Status</th>@if(Auth::user()->level == 'admin')<th>Action</th>@endif
        </tr>
    </thead>


    
    <tbody>
        @foreach ($get_prodiAndSebaran as $row)
        <tr class="text-center">
            <td>{{ $row->kd_kelas}}</td>
            <td>{{ $row->kelas}}</td>
            <td>{{ $row->nama}}</td>
            <td>{{ $row->tahun}}</td>
            <td>{{ $row->semester}}</td>
            <td>{{ $row->mhs}}</td>
            <td>{{ $row->mata_kuliah}}</td>
            <td>{{ $row->sks}}</td>
            <td>{{ $row->teori}}</td>
            <td>{{ $row->praktek}}</td>
            <td>{{ $row->jam}}</td>
            <td>{{ $row->name}}</td>
            <td>{{ $row->name}}</td>
            <td>{{ $row->approved ? 'approved' : 'not approved'}}</td>
            @if(Auth::user()->level == 'admin')
            <td><div class="d-flex justify-content-center">
            @if(!$row->approved)
                <a href="{{ route('sebaran.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit mr-2" title="Edit"></a>
                @endif
                <form action="{{route('sebaran.destroy',$row->id)}}" method="post" title="Hapus">
                    @csrf
                    @method('Delete')
                    <button class="btn btn-danger btn-sm fas fa-trash-alt mr-2 "
                        onclick="return confirm('Yakin mau menghapus data ini ?')" type="submit"></button>
                </form>
                @if(!$row->approved)        
                <a href="{{route('sebaran.approve',$row->id)}}" class="" title="Konfirmasi"   type="submit"><img src="{{ asset('icons/check.png')}} " width="30px" height="30px" alt=""> </a>

                  
               
            </div>
            </td>
            @endif
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

@if(Auth::user()->level == 'prodi')
<a href="{{ route('sebaran.create') }}" class="btn btn-success ">Tambah Data</a>
@endif
<a href="{{ route('home') }}" class="btn btn-danger ">Kembali</a>
</section>

@endsection
