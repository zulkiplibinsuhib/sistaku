@extends('layout')
@section('title','Daftar Mata Kuliah')
@section('content')


<div>
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     Kurikulum
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
{{ Link_to('matkul?kurikulum=2016','2016',['class'=>'dropdown-item'])}} 
        {{ Link_to('matkul?kurikulum=2017','2017',['class'=>'dropdown-item'])}}
        {{ Link_to('matkul?kurikulum=2018','2018',['class'=>'dropdown-item'])}}
        
</div>
</div>
   
      
<table class="table table-bordered">
        <tr><th>Kode</th><th>Mata Kuliah</th><th>SKS</th><th>Kurikulum</th><th>Prodi</th><th colspan="2">Action</th></tr>
        @foreach ($get_ProdiAndMatkul as $row)
            <tr><td>{{ $row->kode_matkul}}</td>
                <td>{{ $row->matkul}}</td>
                <td>{{ $row->sks}}</td>
                <td>{{ $row->kurikulum}}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ link_to('matkul/'.$row->id.'/edit','Edit') }}</td>
             
                <td>
                    
                    {{ Form::open(['url'=>'matkul/'.$row->id,'method'=>'delete'])}}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger btn-sm'])}}
                    {{ Form::close()}}
                </td>


            </tr>
        @endforeach
    </table>
{{link_to('matkul/create','Tambah Mata Kuliah Baru',['class'=>'btn btn-success'])}}
{{ Link_to('home','Kembali',['class'=>'btn btn-danger'])}}
@endsection()