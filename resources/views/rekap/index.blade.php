@extends('layout')
@section('title','Daftar Dosen')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<a class="btn btn-warning" href="{{ route('exportdosen') }}">Export</a>
<form class="form-inline" action="" method="get">
    <select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $prodi)
        <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
        @endforeach
    </select>
    <select name="dosen" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>NIDN</option>
        @foreach($cari_dosen as $dosen)
        <option value="{{$dosen->nidn}}">{{$dosen->name}}</option>
        @endforeach
    </select>
    <select name="tahun" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Tahun Akademik</option>
        @foreach($cari_tahun as $dosen)
        <option value="{{$dosen->tahun}}">{{$dosen->tahun}}</option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary my-1 ">Cari</button>
</form>

		
<table class="table table-bordered" id="dosen">
    <thead>
        <tr class="text-center">
            <th>Nama Dosen</th>
            <th>NIDN</th>
           
            <th>Bidang</th>
            <th>Jumlah SKS</th>
            <!-- <th>Prodi</th> -->
            <th>Jumlah Jam Mengajar</th>
            <th>Mata Kuliah Diambil</th>
            
        </tr>
    </thead>
    <tbody>
        
        @foreach ($get_prodiAndDosen as $row)
        <tr >
            <td class="text-center">{{ $row->name}}</td>
            <td class="text-center">{{ $row->nidn}}</td>
            <!-- <td>{{ $row->nama}}</td> -->
            <!-- <td>{{ $row->tahun}}</td> -->
            <td class="text-center">{{ $row->bidang}}</td>
            <td class="text-center">{{ $row->jumlah_sks}}</td>
            <td class="text-center">{{ $row->jumlah_jam}}</td>
            <td> @foreach($row->matkul_diambil as $matkul) {{$row->no++}}. {{ $matkul->mata_kuliah }} = {{ $matkul->nama }}
                 <br>@endforeach</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
{{ Link_to('home','Kembali',['class'=>'btn btn-danger'])}}


@endsection
