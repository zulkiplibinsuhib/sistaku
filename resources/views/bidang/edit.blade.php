@extends('layout')
@section('title','bidang')
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
                <h3 class="card-title text-bold"> <i class="fas fa-edit text-dark mr-2"></i>Form Update bidang
                </h3>
            </div>
            <div class="card-body">
                {{ Form::model($bidang_dosen,['url'=>'bidang/'.$bidang_dosen->id,'method'=>'put'])}}
                <table class="table table-borderless">

                    <tr>
                        <td> <label class="offset-4">Nama bidang</label>
                        <td>{{ Form::text('nama_bidang',null,['placeholder'=>'Ex. bidang 2019','class'=>'form-control col-10','required'])}}
                        </td>
                        </td>
                    </tr>
                    <tr>{{ Form::hidden('prodi',null,['placeholder'=>'','class'=>'form-control','required','readonly'])}}
                    </tr>

                </table>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Update</button>
                    <a href="{{ route('bidang.index')}}" class="btn btn-default ">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
