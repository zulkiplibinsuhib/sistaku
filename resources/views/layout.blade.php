<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>SISTAKU</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_lte/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-navy ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block ">
                    <a href="{{route('home')}}" class="nav-link ">Home</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">

                    <a class="nav-link fas fa-sign-out-alt" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-navy elevation-4">
            <!-- Brand Logo -->
            <a href="home" class="brand-link navbar-light ">
                <img src="{{ asset('admin_lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light-bold">SISTAKU</span>
            </a>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('admin_lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block"> {{ Auth::user()->name }} </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                @if(Auth::user()->level == 'admin')
                                <li class="nav-item">
                                    <a href="{{ route('prodi.index')}}" class="nav-link">
                                        <i class="far fa-file-alt nav-icon"></i>
                                        <p>Program Studi</p>
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('kelas.index')}}" class="nav-link">
                                        <i class="far fas fa-cube nav-icon"></i>
                                        <p>Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('matkul.index')}}" class="nav-link">
                                        <i class="fas fa-book-open nav-icon"></i>
                                        <p>Mata Kuliah</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dosen.index')}}" class="nav-link">
                                        <i class="far fa-id-badge nav-icon"></i>
                                        <p>Dosen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sebaran.index')}}" class="nav-link">
                                        <i class="fas fa-file-archive nav-icon"></i>
                                        <p>Sebaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.index')}}" class="nav-link">
                                        <i class="fas fa-file-archive nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('title')</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>


    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin_lte/dist/js/adminlte.min.js') }}"></script>

    <!-- Data Table -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src=" {{ asset('js/app.js') }}"></script>
  
    
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

    <!-- AJAX KODE KELAS CREATE -->
    <script type="text/javascript">
      $(document).ready(function(){
          console.log($('#kode'))
         $('#kode').on('input',function(){
             var kode=$(this).val();
             $.ajax({
                 type : "GET",
                 url  : "{{ route('sebaran.ajax_select') }}",
                 dataType : "JSON",
                 data : {kode: kode},
                 cache:false,
                 success: function(data){
                   console.log(data);
                   var json = data;
                    var kelas = json.kelas;
                    var semester = json.semester;
                    var mhs = json.mhs;
                    
                    console.log(kelas);
                    console.log(semester);
                    console.log(mhs);
                    
                    $('#kelas-sebaran').val(kelas);
                    $('#semester-sebaran').val(semester);
                    $('#mhs-sebaran').val(mhs);
                                          
                 }
             });
             return false;
        });
      });

    </script>

<!-- AJAX MATA KULIAH CREATE -->
<script type="text/javascript">
      $(document).ready(function(){
          console.log($('#nama'))
         $('#nama').on('input',function(){
            // var sms = $('#semester-sebaran').val();
            var kode=$(this).val();
             $.ajax({
                 type : "GET",
                 url  : "{{ route('sebaran.ajax_select_matkul') }}",
                 dataType : "JSON",
                 data : {kode: kode},
                 cache:false,
                 success: function(data){
                   console.log(data);
                   var json = data;
                    var sks = json.sks;
                    console.log(sks);
                    $('#sks').val(sks);
                                          
                 }
             });
             return false;
        });
      });

    </script>
    

    <!-- AJAX MATA KULIAH EDIT -->
<script type="text/javascript">
      $(document).ready(function(){
          console.log($('#matkul-edit'))
         $('#matkul-edit').on('input',function(){
             var kode=$(this).val();
             $.ajax({
                 type : "GET",
                 url  : "{{ route('sebaran.ajax_select_matkul_edit') }}",
                 dataType : "JSON",
                 data : {kode: kode},
                 cache:false,
                 success: function(data){
                   console.log(data);
                   var json = data;
                    var sks = json.sks;
                    console.log(sks);
                    $('#sks-edit').val(sks);
                                          
                 }
             });
             return false;
        });
      });

    </script>
   
    <script>
    $(document).ready(function() {
            $('#prodi').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
    <script>
    $(document).ready(function() {
            $('#matkul').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
    <script>
    $(document).ready(function() {
            $('#kelas ').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
    <script>
    $(document).ready(function() {
            $('#dosen ').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('.sebaran').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
 
    

              










</body>

</html>
