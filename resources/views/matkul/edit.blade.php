@extends('layout')
@section('title','SISTAKU')
@section('content')

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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Mata Kuliah
                </h3>
            </div>
            <div class="card-body">
                {{ Form::model($matkul,['url'=>'matkul/'.$matkul->id,'method'=>'put'])}}
                <table class="table table-borderless">
                    <tr>
                        <td><label class="offset-4">Kode Mata Kuliah</label>
                        <td>{{ Form::text('kode_matkul',null,['placeholder'=>'Kode Matkul','class'=>'form-control col-10 ','required','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Mata Kuliah </label>
                        <td>{{ Form::text('matkul',null,['placeholder'=>'mata kuliah','class'=>'form-control col-10','required','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td> <label class="offset-4">SKS</label>
                        <td>{{ Form::number('sks',null,['placeholder'=>'sks','class'=>'form-control col-10','required','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Teori</label> </td>
                        <td>{{ Form::number('teori',null,['placeholder'=>'Enter jam teori','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Praktek</label> </td>
                        <td>{{ Form::number('praktek',null,['placeholder'=>'Enter jam praktek','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Jam / Minggu</label> </td>
                        <td>{{ Form::number('jam_minggu',null,['placeholder'=>'Enter jam per minggu','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Tahun Akademik</label> </td>
                        <td>{{ Form::number('tahun',null,['placeholder'=>'masukkan tahun akademik','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Kurikulum</label>
                        <td>{{ Form::select('kurikulum',['2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018'],'null',['class'=>'form-control col-10','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Semester</label> </td>
                        <td>{{  Form::number('semester',null,['placeholder'=>'Enter Semester','class'=>'form-control col-10','required'])}}
                        </td>
                    </tr>
                    @if(empty(Auth::user()->prodi))
                    <tr>{{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control','required','readonly'])}}
                    </tr>


                    @endif

                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update</button>
                    <a href="{{ route('matkul.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
