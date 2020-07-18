@extends('layout')
@section('title','Daftar Dosen')
@section('content')
<form class="form-inline" action="" method="get">
<select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $prodi)
          <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
        @endforeach
  </select>
  <button type="submit" class="btn btn-primary my-1 btn-sm">Search</button>
</form>
<table class="table table-bordered">
        <tr><th>Nama Dosen</th><th>NIDN</th><th>Jenis Kelamin</th><th>Status</th><th>Prodi</th><th>Jumlah Jam Mengajar</th><th colspan="3">Action</th></tr>
        @foreach ($get_prodiAndDosen as $row)
            <tr><td>{{ $row->name}}</td>
                <td>{{ $row->nidn}}</td> 
                <td>{{ $row->jenis_kelamin}}</td>
                <td>{{ $row->status}}</td>
                <td>{{ $row->nama}}</td>
                <td>{{ $row->jumlah_jam}}</td>
                <td>{{ link_to('dosen/'.$row->id.'/edit','Edit',['class'=>'btn btn-warning  btn-sm']) }}</td>
               
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




