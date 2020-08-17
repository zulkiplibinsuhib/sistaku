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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Input Program Studi
                </h3>
            </div>
            <div class="card-body">
                {{ Form::open(['url'=>'prodi'])}}
                <table class="table table-borderless">

                    <tr>
                        <td><label class="offset-4">Kode Prodi</label> </td>
                        <td>{{ Form::text('kode',null,['placeholder'=>'Enter kode prodi ','class'=>'form-control col-10 ','required'])}}
                        </td>
                    </tr>
                    <tr>
                        <td><label class="offset-4">Prodi</label> </td>
                        <td>{{ Form::text('nama',null,['placeholder'=>'Enter nama prodi','class'=>'form-control col-10 ','required'])}}
                        </td>
                    </tr>

                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Input</button>
                    <a href="{{ route('prodi.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
