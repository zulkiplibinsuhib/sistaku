@extends('layout')
@section('title','Dosen')
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

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show col-4" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline text-sm-3">
            <div class="card-header">
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Create Dosen
                </h3>
            </div>
            <div class="card-body">
                {{ Form::open(['url'=>'dosen'])}}
                <table class="table table-borderless">

                    <tr>
                        <td><label class="offset-4">Nama Dosen</label> </td>
                        <td>{{ Form::text('name',null,['placeholder'=>'Masukkan Nama Lengkap Dosen  ','class'=>'form-control col-10' ,'required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">NIDN</label> </td>
                        <td>{{ Form::number('nidn',null,['placeholder'=>'Masukkan NIDN','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Jenis Kelamin</label> </td>
                        <td>{{ Form::select('jenis_kelamin',['Laki-Laki'=>'Laki-Laki','Perempuan'=>'Perempuan'],null,['class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Status</label> </td>
                        <td>{{ Form::select('status',['Tetap'=>'Tetap','Tidak Tetap'=>'Tidak Tetap'],null,['class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Bidang</label> </td>
                        <td><select name="bidang" class="form-control col-10" required>
                                <option selected disabled>Pilih Bidang Dosen</option>
                                @foreach($bidang_dosen as $bidang)
                                <option value="{{$bidang->id}}">{{$bidang->nama_bidang}}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    @if(empty(Auth::user()->prodi))
                    <tr>
                        <td><label class="offset-4" for="prodi">Prodi</label></td>
                        <td><select name="prodi" class="form-control col-10" required>
                                <option selected disabled>Pilih Prodi</option>
                                <option value="all">All Prodi</option>
                                @foreach(App\Prodi::all() as $prodi)
                                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    @endif

                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Input</button>
                    <a href="{{ route('dosen.index')}}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
