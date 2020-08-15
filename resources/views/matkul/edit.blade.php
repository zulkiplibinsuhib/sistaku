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
<div class="row">
    <div class="col-12">
        <div class="card card-info card-outline text-sm-3">
            <div class="card-header">
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Mata Kuliah
                </h3>
            </div>
            <div class="card-body">
                {{ Form::model($matkul,['url'=>'matkul/'.$matkul->id,'method'=>'put'])}}
                <table class="table table-borderless">
                    <tr>
                        <td><label>Kode Mata Kuliah</label>
                        <td>{{ Form::text('kode_matkul',null,['placeholder'=>'Kode Matkul','class'=>'form-control col-md-4','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Mata Kuliah </label>
                        <td>{{ Form::text('matkul',null,['placeholder'=>'mata kuliah','class'=>'form-control col-md-4','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td> <label>SKS</label>
                        <td>{{ Form::number('sks',null,['placeholder'=>'sks','class'=>'form-control col-md-4','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Teori</label> </td>
                        <td>{{ Form::number('teori',null,['placeholder'=>'Enter jam teori','class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label>Praktek</label> </td>
                        <td>{{ Form::number('praktek',null,['placeholder'=>'Enter jam praktek','class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label>Jam / Minggu</label> </td>
                        <td>{{ Form::number('jam_minggu',null,['placeholder'=>'Enter jam per minggu','class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label>Tahun Akademik</label> </td>
                        <td>{{ Form::number('tahun',null,['placeholder'=>'masukkan tahun akademik','class'=>'form-control col-md-4','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label>Kurikulum</label>
                        <td>{{ Form::select('kurikulum',['2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018'],'null',['class'=>'form-control col-md-4'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Semester</label> </td>
                        <td>{{  Form::number('semester',null,['placeholder'=>'Enter Semester','class'=>'form-control col-md-4'])}}
                        </td>
                    </tr>
                    @if(empty(Auth::user()->prodi))
                    <tr>{{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control','required','readonly'])}}
                    </tr>


                    @endif

                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Input</button>
                    <a href="{{ route('matkul.index')}}" class="btn btn-default float-right">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
