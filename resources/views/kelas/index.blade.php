@extends('layout')
@section('title','Daftar Kelas')
@section('content') 

<table class="table table-bordered">
        <tr><th>Kode Kelas</th><th>Prodi</th><th>Semester</th><th>Mhs</th><th>keterangan</th><th colspan="2">Action</th></tr>
        @foreach ($get_prodiAndKelas as $row)
            <tr><td>{{ $row->kode}}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ $row->semester}}</td>
                <td>{{ $row->mhs}}</td>
                <td>{{ $row->keterangan}}</td>
                <td>{{ link_to('kelas/'.$row->id.'/edit','Edit',['class'=>'btn btn-warning']) }}</td>
             
                <td>
                    
                    {{ Form::open(['url'=>'kelas/'.$row->id,'method'=>'delete'])}}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger'])}}
                    {{ Form::close()}}
                </td>


            </tr>
        @endforeach
    </table>
{{link_to('kelas/create','Tambah Kelas Baru',['class'=>'btn btn-success'])}}
{{ Link_to('home','Kembali',['class'=>'btn btn-danger'])}}
@endsection()