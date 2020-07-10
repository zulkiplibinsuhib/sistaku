@extends('layout')
@section('title','Sebaran Politeknik TEDC Bandung')
@section('content')

<table class="table table-bordered">
        <tr><th>Kode Kelas</th><th>Kelas</th><th>Prodi</th><th>Semester</th><th>Mhs</th><th>Mata Kuliah</th><th>SKS</th><th>Jam</th><th>Dosen Mengajar</th><th colspan="2">Action</th></tr>
        @foreach ($get_prodiAndSebaran as $row)
            <tr><td>{{ $row->kd_kelas}}</td>
                <td>{{ $row->kelas}}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ $row->semester}}</td>
                <td>{{ $row->mhs}}</td>
                <td>{{ $row->mata_kuliah}}</td>
                <td>{{ $row->sks}}</td>
                <td>{{ $row->jam}}</td>
                <td>{{ $row->dosen_mengajar}}</td>
                
                <td>{{ link_to('sebaran/'.$row->id.'/edit','Edit') }}</td>
             
                <td>
                    
                    {{ Form::open(['url'=>'sebaran/'.$row->id,'method'=>'delete'])}}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                    {{ Form::close()}}
                </td>


            </tr>
        @endforeach
    </table>
  
    
    {{link_to('sebaran/create','Tambah Sebaran Baru',['class'=>'btn btn-success'])}}
   
    {{ Link_to('home','Kembali',['class'=>'btn btn-danger'])}}
    @endsection()