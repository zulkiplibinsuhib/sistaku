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
                        <input type="text" class="form-control card-tools mr-sm-2" style=" width: 100px;" name="jam"
                                        id="jam" placeholder="Maks. Jam">
                            <select name="prodi" class="custom-select my-1 mr-sm-2" style=" width: 200px;"
                                id="inlineFormCustomSelectPref">
                                
                                <option selected disabled>Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select>

                            <select name="tahun" class="custom-select my-1 mr-sm-2" style=" width: 200px;"
                                id="inlineFormCustomSelectPref">
                                <option selected disabled>Tahun Akademik</option>
                                @foreach($cari_tahun as $dosen)
                                <option value="{{$dosen->tahun_akademik}}">{{$dosen->tahun_akademik}}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary my-1 ">Filter</button>
                        </form>
                    </div>

                </div>

                <div class="card-body table-responsive">
                <a href="{{ route('.export') }}"
                                           class="btn btn-secondary" target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                    <table class="table table-bordered table table-striped" id="dosen">
                        <thead>
                            <tr class="text-center <?php?>">
                                <th rowspan="2" class="align-middle">No</th>
                                <th rowspan="2" class="align-middle">Nama Dosen </th>
                                <th rowspan="2" class="align-middle">NIDN</th>
                                <th rowspan="2" class="align-middle">Bidang</th>
                                <th colspan="2">Reguler</th>
                                <th colspan="2">Karyawan</th>
                                <th colspan="2">Total</th>
                                <th rowspan="2" class="align-middle">Mata Kuliah Diambil</th>
                                <!-- <th>Prodi</th> -->
                            </tr>
                            <tr class="text-center <?php?>">
                                <th>SKS</th>
                                </th>
                                <th>JAM</th>
                                <th>SKS</th>
                                <th>Jam</th>
                                <th>SKS</th>
                                <th>Jam</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            $no=1?>
                            
                            @foreach ($get_prodiAndDosen as $row)
                            @if($row->total_jam > $jam )
                            <tr>
                                <td class="text-center">{{ $no++}} </td>
                                <td class="text-center">{{ $row->name}}</td>
                                <td class="text-center">{{ $row->nidn}}</td>
                                <!-- <td>{{ $row->nama}}</td> -->
                                <td class="text-center">{{ $row->bidang}}</td>
                                <td class="text-center">{{ $row->jumlah_sks}}</td>
                                <td class="text-center">{{ $row->jumlah_jam}}</td>
                                <td class="text-center">{{ $row->jumlah_sks_karyawan}}</td>
                                <td class="text-center">{{ $row->jumlah_jam_karyawan}}</td>
                                <td class="text-center">{{ $row->total_sks}}</td>
                                <td class="text-center">{{ $row->total_jam}}</td>
                                <td> @foreach($row->matkul_diambil as $matkul) {{$row->no++}}.
                                    {{ $matkul->matkul }} = {{ $matkul->nama }}
                                    <br>@endforeach</td>

                            </tr>
                            @endif
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
