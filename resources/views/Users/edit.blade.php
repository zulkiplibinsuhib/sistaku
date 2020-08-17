@extends('layout')
@section('title','Update Data Program Studi')
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

{{ Form::model($prodi,['url'=>'prodi/'.$prodi->id,'method'=>'put'])}}
<table class="table table-bordered">
    <tr>
        <td> Kode Prodi
        <td>{{ Form::text('kode',null,['placeholder'=>'Kode prodi','class'=>'form-control','required'])}}</td>
        </td>
    </tr>
    <tr>
        <td> Prodi
        <td>{{ Form::text('nama',null,['placeholder'=>'Program studi','class'=>'form-control','required'])}}</td>
        </td>
    </tr>

    <tr>
        <td></td>
        <td>
            {{ Form::submit('Update Data',['class'=>'btn btn-success'])}}
            {{ Link_to('prodi','Kembali',['class'=>'btn btn-danger'])}}
            {{ Form::close()}}
        </td>
    </tr>
</table>
@endsection
