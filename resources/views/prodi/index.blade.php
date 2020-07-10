@extends('layout')
@section('title','Daftar Program Studi')
@section('content')

<table class="table table-bordered">
        <tr><th>Kode Prodi</th><th>Prodi</th><th colspan="2">Action</th></tr>
        @foreach ($prodi as $row)
            <tr><td>{{ $row->kode}}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ link_to('prodi/'.$row->id.'/edit','Edit',['class'=>'btn btn-warning']) }}</td>
             
                <td>
                    
                    {{ Form::open(['url'=>'prodi/'.$row->id,'method'=>'delete'])}}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                    {{ Form::close()}}
                </td>


            </tr>
        @endforeach
    </table>
{{link_to('prodi/create','Tambah Prodi Baru',['class'=>'btn btn-success'])}}
{{ Link_to('home','Kembali',['class'=>'btn btn-danger'])}}
@endsection()