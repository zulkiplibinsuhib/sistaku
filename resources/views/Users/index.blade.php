@extends('layout')
@section('title','SISTAKU')
@section('content')
<!-- <form class="form-inline" action="" method="get">
    <select name="prodi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected disabled>Prodi</option>
        @foreach(App\Prodi::all() as $dataprodi)
        <option value="{{$dataprodi->id}}">{{$dataprodi->nama}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary my-1 btn-sm">Search</button>
</form> -->
<section class="content">

    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline text-sm-3">
                <div class="card-header">
                    <h3 class="card-title text-bold"> <i class="fas fa-list-alt text-dark mr-2"></i>Daftar Users
                    </h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered" id="prodi">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Program Studi</th>
                                <th>Level</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @foreach ($users as $row)
                            <tr class="text-center">
                                <td>{{$no++}} </td>
                                <td>{{ $row->name}}</td>
                                <td>{{ $row->email}}</td>
                                <td>{{ $row->prodi}}</td>
                                <td>{{ $row->level}}</td>

                                <td>

                                    <form action="{{route('users.destroy',$row->id)}}" method="post" title="Hapus">
                                        @csrf
                                        @method('Delete')
                                        <button class="btn btn-danger btn-sm fas fa-trash-alt "
                                            onclick="return confirm('Yakin Mau di Hapus ?')" type="submit"></button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('home') }}" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    </div>
</section>

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
