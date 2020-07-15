@extends('layout')
@section('title','Update Data Dosen')
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

    {{ Form::model($dosen,['url'=>'dosen/'.$dosen->id,'method'=>'put'])}}
    <table class="table table-bordered">
        <tr><td>Nama Dosen <td> {{ Form::text('name',null,['placeholder'=>'Nama Dosen','class'=>'form-control ','required'])}}</td></td></tr>
        <tr><td>NIDN <td> {{ Form::number('nidn',null,['placeholder'=>'NIDN','class'=>'form-control col-md-4'],'required')}}</td></td></tr>
        <tr><td>Jenis Kelamin <td> {{ Form::select('jenis_kelamin',['Laki-Laki'=>'Laki-Laki','Perempuan'=>'Perempuan'],null,['class'=>'form-control col-md-4'])}}</td></td></tr> 
        <tr><td> Status <td>  {{ Form::select('status',['aktif'=>'Aktif','Tidak Aktif'=>'Tidak Aktif'],null,['class'=>'form-control col-md-4'])}}</td></td></tr>
        
        <tr><td></td><td>  
        {{ Form::submit('Update Data',['class'=>'btn btn-success'])}}
        {{ Link_to('dosen','Kembali',['class'=>'btn btn-danger'])}}
        {{ Form::close()}}
        </td></tr>
    </table>
@endsection