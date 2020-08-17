@extends('layout')
@section('title','SISTAKU')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{asset('icons/user.png')}}""
                       alt=" User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{$dosen->name}} </h3>
                            <p class="text-muted text-center">Dosen</p>
                            <p class="text-muted text-center text-bold"> Politeknik TEDC Bandung</p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title text-bold">About
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="far fa-id-card mr-1"></i> NIDN</strong>
                            <p class="text-muted">{{$dosen->nidn}}</p>
                            <hr>
                            <strong><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>
                            <p class="text-muted">
                            {{$dosen->jenis_kelamin}}
                            </p>
                            <hr>
                            <strong><i class="fas fa-book mr-1"></i> Bidang</strong>
                            <p class="text-muted">
                            {{$dosen->bidang}}
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Status Dosen</strong>
                            <p class="text-muted">{{$dosen->status}}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info card-outline text-sm-3">
                                <div class="card-header">
                                    <h3 class="card-title text-bold">Detail Mengajar
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Total SKS</label>
                                            <div class="col-sm-2 text-muted">
                                                <p class="form-control">{{$jumlah_sks}} SKS</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Total Jam </label>
                                            <div class="col-sm-2 text-muted">
                                                <p class="form-control">{{$jumlah_jam}} Jam</p>
                                            </div>
                                        </div>
                                        <hr>

                                    </form>

                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Prodi</th>
                                                    <th>Mata Kuliah</th>
                                                    <th>SKS</th>
                                                    <th>Jam</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;?>
                                                @foreach ($get_data as $row)
                                                <tr class="text-center">
                                                    <td>{{$no++}} </td>
                                                    <td>{{$row->nama}} </td>
                                                    <td>{{$row->mata_kuliah}} </td>
                                                    <td>{{$row->sks}} </td>
                                                    <td>{{$row->jam}} </td>

                                                </tr>
                                                @endforeach
                                            </tbody>


                                        </table>

                                    </div>

                                    <div class="card-footer">

                                        <a href="{{ route('dosen.index')}}" class="btn btn-default">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
