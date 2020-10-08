@extends('layout')
@section('title','Bidang Dosen')
@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show col-4" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<section class="content">

    <div class="row">
        <div class="col-12">
            <div class="card card-info card-outline text-sm-3">
                <div class="card-header">
                    <h3 class="card-title text-bold">
                        <i class="fas fa-list-alt text-dark mr-2"></i>List Bidang Dosen
                    </h3>

                </div>
                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped" id="prodi">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Bidang</th>
                                <th>Prodi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @foreach ($bidang as $row)
                            <tr class="text-center">
                                <td>{{ $no++}}</td>
                                <td>{{ $row->nama_bidang}}</td>
                                <td>{{ $row->nama_prodi}}</td>
                                <td>
                                    <div class="d-flex justify-content-center align">
                                        <div>
                                            <a href="{{ route('bidang.edit',$row->id) }}"
                                            class="btn btn-sm btn-warning fas fa-edit mr-2"
                                            title=" Edit"></a>
                                        </div>
                                        <div>
                                            <form action="{{route('bidang.destroy',$row->id)}}" method="post" title="Hapus">
                                                @csrf @method('Delete')
                                                <button class="btn btn-danger btn-sm fas fa-trash-alt "
                                                    onclick="return confirm('Yakin Mau di Hapus ?')"
                                                    type="submit">
                                                </button>
                                        </div>
                                        </form>
                                    </td>
                                </div>
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
