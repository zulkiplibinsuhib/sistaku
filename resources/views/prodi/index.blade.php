@extends('layout')
@section('title','Daftar Program Studi')
@section('content')
<form class="form-inline" action="" method="get">
<select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $dataprodi)
          <option value="{{$dataprodi->id}}">{{$dataprodi->nama}}</option>
        @endforeach
  </select>
  <button type="submit" class="btn btn-primary my-1 btn-sm">Search</button>
</form>

<table class="table table-bordered">
        <tr><th>Kode Prodi</th><th>Prodi</th><th colspan="2">Action</th></tr>
        @foreach ($prodi as $row)
            <tr><td>{{ $row->kode}}</td>
                <td>{{ $row->nama}}</td>
                <td><a href="{{ route('prodi.edit',$row->id) }}" class="btn btn-sm btn-warning fas fa-edit "></a><td>
                    <form action="{{route('prodi.destroy',$row->id)}}" method="post">
                            @csrf
                            @method('Delete')
                            <button class="btn btn-danger btn-sm fas fa-trash-alt " onclick="return confirm('Yakin Mau di Hapus ?')" type="submit"></button>
                        </form>
                </td>
            </tr>
        @endforeach
    </table>

<a href="{{ route('prodi.create') }}" class="btn btn-success  ">Tambah Data</a>
<a href="{{ route('home') }}" class="btn btn-danger ">Kembali</a>
@endsection()

<script>
  
Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
})
</script>


