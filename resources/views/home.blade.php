@extends('layout')
@section('title')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
<div>
      <div class="callout callout-warning" style="margin:-15px 15px 15px 15px;">											
          <h4><i class=""></i> SISTEM INFORMASI PENENTUAN DOSEN PENGAMPU MATA KULIAH</h4>
          Selamat Datang Operator di SISTAKU. Disini Anda Dapat melakukan pengelolaan data Akademik , seperti memanajemen data dosen, mata kuliah, kelas dan membuat sebaran mata kuliah. Salam dan Terimakasih
      </div>
  </div>
    @if(Auth::user()->level == 'admin')
    <div class="col-6">
        <!-- small box -->
        <div class="small-box bg-info text-center ">
            <div class="inner">
                <h3>
                    {{$prodi}}
                </h3>
                <h4>Program Studi</h4>
            </div>
            <div class="icon">
                <i class="far fa-file-alt"></i>
            </div>
            <a href="prodi" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
    <div class="col-6">
        <div class="small-box bg-orange text-center">
            <div class="inner">
                <h3>{{$dosen}}</h3>
                <h4>Dosen</h4>

            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="dosen" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-6">
        <!-- small box   -->
        <div class="small-box bg-success text-center">
            <div class="inner">
                <h3>{{$kelas}}</h3>
                <h4>Kelas</h4>
            </div>
            <div class="icon">
                <i class="far fas fa-cube"></i>
            </div>
            <a href="kelas" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-6">
        <!-- small box -->

        <div class="small-box bg-warning text-center">
            <div class="inner">
                <h3>
                    {{$matkul}}
                </h3>
                <h4>Mata Kuliah</h4>
            </div>
            <div class="icon">
                <i class="fas fa-book-open"></i>
            </div>
            <a href="matkul" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-6">
        <div class="small-box bg-danger text-center">
            <div class="inner">
                <h3>{{$sebaran}}</h3>
                <h4>Sebaran</h4>
            </div>
            <div class="icon">
                <i class="fas fa-file-archive"></i>
            </div>
            <a href="sebaran" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @if(Auth::user()->level == 'admin')
    <div class="col-6">
        <!-- small box -->
        <div class="small-box bg-info text-center ">
            <div class="inner">
                <h3>
                    {{$dosen}}
                </h3>
                <h4>Rekapitulasi</h4>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="rekap" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
    @if(Auth::user()->level == 'admin')
    <div class="col-6">
        <!-- small box -->
        <div class="small-box bg-success text-center ">
            <div class="inner">
                <h3>
                    {{$users}}
                </h3>
                <h4>Users</h4>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="users" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
    

</div>
<!-- /.row -->
@endsection()
