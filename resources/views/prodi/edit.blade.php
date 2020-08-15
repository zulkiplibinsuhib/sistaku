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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update Program Studi
                </h3>
            </div>
            <div class="card-body">
                {{ Form::model($prodi,['url'=>'prodi/'.$prodi->id,'method'=>'put'])}}
                <table class="table table-bordered">
                    <tr>
                        <td> <label>Kode Prodi</label>
                        <td>{{ Form::text('kode',null,['placeholder'=>'Kode prodi','class'=>'form-control col-md-4','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td> <label>Prodi</label>
                        <td>{{ Form::text('nama',null,['placeholder'=>'Program studi','class'=>'form-control col-md-4','required'])}}
                        </td>
                        </td>
                    </tr>


                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Input</button>
                    <a href="{{ route('prodi.index')}}" class="btn btn-default float-right">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
