@extends('layout')
@section('title','SISTAKU)
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
<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline text-sm-3">
            <div class="card-header">
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Input Dosen
                </h3>
            </div>
            <div class="card-body">
                {{ Form::open(['url'=>'dosen'])}}
                <table class="table table-borderless">

                    <tr>
                        <td><label>Nama Dosen</label> </td>
                        <td>{{ Form::text('name',null,['placeholder'=>'Enter Nama Dosen ','class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label>NIDN</label> </td>
                        <td>{{ Form::number('nidn',null,['placeholder'=>'Enter NIDN','class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label>Jenis Kelamin</label> </td>
                        <td>{{ Form::select('jenis_kelamin',['Laki-Laki'=>'Laki-Laki','Perempuan'=>'Perempuan'],null,['class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label>Status</label> </td>
                        <td>{{ Form::select('status',['Tetap'=>'Tetap','Tidak Tetap'=>'Tidak Tetap'],null,['class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label>Bidang</label> </td>
                        <td>{{ Form::select('bidang',['Produktif'=>'Produktif','MKDU'=>'MKDU'],null,['class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    @if(empty(Auth::user()->prodi))
                    <tr>
                        <td><label for="prodi">Prodi</label></td>
                        <td><select name="prodi" class="form-control col-md-4">
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
                    <button type="submit" class="btn btn-info">Input</button>
                    <a href="{{ route('dosen.index')}}" class="btn btn-default float-right">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
