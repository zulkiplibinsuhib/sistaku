@extends('layout')
@section('title','Daftar Dosen')
@section('content')
<table class="table table-bordered">
        <tr><th>Nama Dosen</th><th>NIDN</th><th>Jenis Kelamin</th><th>Status</th><th>Prodi</th><th colspan="2">Action</th></tr>
        @foreach ($get_prodiAndDosen as $row)
            <tr><td>{{ $row->name}}</td>
                <td>{{ $row->nidn}}</td>
                <td>{{ $row->jenis_kelamin}}</td>
                <td>{{ $row->status}}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ link_to('dosen/'.$row->id.'/edit','Edit') }}</td>
             
                <td>
                    
                    {{ Form::open(['url'=>'dosen/'.$row->id,'method'=>'delete'])}}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                    {{ Form::close()}}
                </td>


            </tr>
        @endforeach
    </table>
    
    {{link_to('dosen/create','Tambah Dosen Baru',['class'=>'btn btn-success'])}}
    
    {{ Link_to('home','Kembali',['class'=>'btn btn-danger'])}}
@endsection()