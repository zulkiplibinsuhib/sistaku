@extends('layout')
@section('title','SISTAKU')
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
<section class="content">

    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline text-sm-3">
                <div class="card-header">
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>Daftar Rekapitulasi
                    </h3>
                    <div class="card-tools ">
                        <form class="form-inline" action="" method="get">
                            <select name="prodi" class="custom-select my-1 mr-sm-2 style="width: 200px;"" id="inlineFormCustomSelectPref">
                                <option selected disabled>Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select>
                            
                            <select name="tahun" class="custom-select my-1 mr-sm-2 style="width: 200px;"" id="inlineFormCustomSelectPref">
                                <option selected disabled>Tahun Akademik</option>
                                @foreach($cari_tahun as $dosen)
                                <option value="{{$dosen->tahun}}">{{$dosen->tahun}}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary my-1 ">Filter</button>
                        </form>
                    </div>
                    
                </div>
                <div class="card-body table-responsive">
                        <table class="table table-bordered" id="dosen">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
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
                                <?php $no=1?>
                                @foreach ($get_prodiAndDosen as $row)
                                <tr>
                                    <td class="text-center">{{ $no++}} </td>
                                    <td class="text-center">{{ $row->name}}</td>
                                    <td class="text-center">{{ $row->nidn}}</td>
                                    <!-- <td>{{ $row->nama}}</td> -->
                                    <!-- <td>{{ $row->tahun}}</td> -->
                                    <td class="text-center">{{ $row->bidang}}</td>
                                    <td class="text-center">{{ $row->jumlah_sks}}</td>
                                    <td class="text-center">{{ $row->jumlah_jam}}</td>
                                    <td> @foreach($row->matkul_diambil as $matkul) {{$row->no++}}.
                                        {{ $matkul->mata_kuliah }} = {{ $matkul->nama }}
                                        <br>@endforeach</td>

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





@endsection
