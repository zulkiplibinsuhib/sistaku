@extends('layout')
@section('title','Halaman Utama')
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="container-fluid">
      <div class="callout callout-warning col-12" " >											
          <h4><i class=""></i> SISTEM INFORMASI PENENTUAN DOSEN PENGAMPU MATA KULIAH</h4>
          Selamat Datang Operator di SISTAKU. Disini Anda Dapat melakukan pengelolaan data Akademik , seperti mengelola data dosen, mata kuliah tiap kurikulum, kelas dan membuat sebaran mata kuliah serta menentukan dosen pengampu mata kuliah. 
          Sistem informasi ini bertujuan untuk memudahkan proses membuat sebaran di setiap Program Studi dan memudahkan Akademik dalam merekap semua data sebaran serta dapat mengetahui jumlah jam mengajar setiap dosen pengampu mata kuliah. Dengan adanya sistem informasi ini, berharap
          tidak terjadi lagi duplikasi mata kuliah .Salam dan Terimakasih
      </div>
  </div>
    
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        @if(Auth::user()->level == 'admin')
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <a href="prodi" class="info-box-icon bg-info elevation-1"><i class="far fa-file-alt"></i></a>
              <div class="info-box-content">
                <span class="info-box-text">Program Studi</span>
                <span class="info-box-number">
                {{$prodi}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a href="kurikulum" class="info-box-icon bg-danger elevation-1"><i class="far fa-file-alt"></i></a>
              <div class="info-box-content">
                <span class="info-box-text">Kurikulum</span>
                <span class="info-box-number">{{$kurikulum}}</span> 
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a href="dosen"  class="info-box-icon bg-success elevation-1"><i class="fas fa-chalkboard-teacher"></i></a>

              <div class="info-box-content">
                <span class="info-box-text">Dosen</span>
                <span class="info-box-number">{{$dosen}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <a href="kelas" class="info-box-icon bg-warning elevation-1"><i class="far fas fa-cube"></i></a>
              <span ></span>
              <div class="info-box-content">
                <span class="info-box-text">Kelas</span>
                <span class="info-box-number">{{$kelas}}</span>
              </div>
              
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <a href="matkul" class="info-box-icon bg-info elevation-1"><i class="fas fa-book-open"></i></a>
              <div class="info-box-content">
                <span class="info-box-text">Mata Kuliah</span>
                <span class="info-box-number">
                {{$matkul}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a href="sebaran" class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-archive"></i></a>
              <div class="info-box-content">
                <span class="info-box-text">Sebaran</span>
                <span class="info-box-number">{{$sebaran}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a href="rekap"  class="info-box-icon bg-success elevation-1"><i class="ion ion-stats-bars"></i></a>

              <div class="info-box-content">
                <span class="info-box-text">Rekapitulasi</span>
                <span class="info-box-number">{{$dosen}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <a href="kelas" class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></a>
              <span ></span>
              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">{{$users}}</span>
              </div>
              
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
          @if(Auth::user()->level == 'prodi')
          
          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a href="kurikulum" class="info-box-icon bg-danger elevation-1"><i class="far fa-file-alt"></i></a>
              <div class="info-box-content">
                <span class="info-box-text">Kurikulum</span>
                <span class="info-box-number">{{$kurikulum}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3 offset-1">
            <div class="info-box mb-3">
              <a href="dosen"  class="info-box-icon bg-success elevation-1"><i class="fas fa-chalkboard-teacher"></i></a>

              <div class="info-box-content">
                <span class="info-box-text">Dosen</span>
                <span class="info-box-number">{{$dosen}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3 offset-1">
            <div class="info-box mb-3">
                <a href="kelas" class="info-box-icon bg-warning elevation-1"><i class="far fas fa-cube"></i></a>
              <span ></span>
              <div class="info-box-content">
                <span class="info-box-text">Kelas</span>
                <span class="info-box-number">{{$kelas}}</span>
              </div>
              
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3 ">
            <div class="info-box">
              <a href="matkul" class="info-box-icon bg-info elevation-1"><i class="fas fa-book-open"></i></a>
              <div class="info-box-content">
                <span class="info-box-text">Mata Kuliah</span>
                <span class="info-box-number">
                {{$matkul}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-12 col-sm-6 col-md-3 offset-1">
            <div class="info-box mb-3">
              <a href="sebaran" class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-archive"></i></a>
              <div class="info-box-content">
                <span class="info-box-text">Sebaran</span>
                <span class="info-box-number">{{$sebaran}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->

          <!-- fix for small devices only -->
         
          
          @endif
          
          <!-- /.col -->
        </div>
        
    
    

</div>
<!-- /.row -->
@endsection()
