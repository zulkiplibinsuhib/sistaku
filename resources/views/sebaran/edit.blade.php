@extends('layout')
@section('title','Sebaran')
@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show col-4" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Sebaran
                </h3>
            </div>
            <div class="card-body">
                
{{ Form::model($sebaran,['url'=>'sebaran/'.$sebaran->id,'method'=>'put'])}}
<table class="table table-borderless">

    <tr>
        <td><label for="kd_kelas" class="offset-3">Mata Kuliah</label></td>
        <td><label for="" class="form-control col-10" readonly>{{$sebaran->matkul}}</label> </td>
            {{ Form::hidden('id_matkul',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'mata_kuliah', 'readonly'])}}
    </tr>
    <tr>
        <td><label class="offset-3" for="kode">Kode Kelas</label></td>
        <td><select class="form-control col-10" name="kd_kelas" >
                <option selected value="{{$sebaran->id_kelas}}" >{{empty($sebaran->kode)  ? 'Pilih Kelas' :$sebaran->kode}}</option>
                @foreach(App\Kelas::all() as $kelas)
                <option value="{{ $kelas->id}}">{{ $kelas->kode}} - {{ $kelas->tahun}} </option>
                @endforeach
            </select></td>
    </tr>
    <tr> 
        
       {{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'prodi',' readonly'])}}      
       {{ Form::hidden('semester',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'semester',' readonly'])}}      
       {{ Form::hidden('tahun_akademik',null,['placeholder'=>'','class'=>'form-control col-10','name'=>'tahun_akademik',' readonly'])}}      
    </tr>

      
    </tr>
    <tr>
        <td><label class="offset-3" for="dosen">Dosen PDPT</label></td>
        <td><select class="form-control col-10" name="dosen_pdpt" >
                <option selected  value="{{ $sebaran->nidn}}">{{empty($sebaran->name) ? 'Pilih Dosen' :$sebaran->name}}</option>
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen->nidn}}">{{ $dosen->name}} </option>
                @endforeach
            </select></td>
    </tr>
    <tr>
        <td><label class="offset-3" for="dosen">Dosen Mengajar</label></td>
        <td>
            <select class="form-control col-10" name="dosen_mengajar" >
                <option selected value="{{ $sebaran->nidn_pdpt}}" >{{empty($sebaran->dosen_pdpt) ? 'Pilih Dosen' : $sebaran->dosen_pdpt}}</option>
                @foreach($data_dosen as $dosen)
                <option value="{{ $dosen->nidn}}">{{ $dosen->name}}</option>
                @endforeach
            </select></td>
    </tr>

</table>
<div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update</button>
                    <a href="{{ route('sebaran.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
