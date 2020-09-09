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
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed  layout-fixed ">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-info navbar-info ml-auto" ">
            <!-- Left navbar links -->
            <ul class=" navbar-nav ">
                <li class=" nav-item">
            <a class="nav-link text-light" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item  d-sm-inline-block ">
                <a href="{{route('home')}}" class="nav-link text-light  ">HOME</a>
            </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-sm-inline-block ">

                    <a class="nav-link fas fa-sign-out-alt text-light  " href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                              document.getElementById('logout-form').submit(); confirm('Apakah {{ Auth::user()->name }} mau keluar ?')" type="submit">
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
        <aside class="main-sidebar sidebar-light-info elevation-4">
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
                        <img src="{{asset('admin_lte/dist/img/user.jpg')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block"> {{ Auth::user()->name }} </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{route('home')}}" class="nav-link {{Request::is('home')?'active':''}} ">
                                <i class="nav-icon fas fa-home"></i>
                                <p class="text ">
                                    BERANDA
                                </p>
                            </a>
                        </li>

                        @if(Auth::user()->level == 'admin')
                        <li
                            class="nav-item has-treeview {{Request::is('prodi')?'menu-open':''}} {{Request::is('prodi/create')?'menu-open':''}}">
                            <a href="#" class="nav-link  ">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p class="text ">
                                    PROGRAM STUDI
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="{{route('prodi.index')}}"
                                        class=" nav-link {{Request::is('prodi')?'active':''}} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Program Studi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('prodi.create')}}"
                                        class="nav-link {{Request::is('prodi/create')?'active':''}} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Program Studi</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif
                        <li
                            class="nav-item has-treeview {{Request::is('kurikulum')?'menu-open':''}} {{Request::is('kurikulum/create')?'menu-open':''}}">
                            <a href="#" class="nav-link  ">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p class="text ">
                                    KURIKULUM
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="{{route('kurikulum.index')}}"
                                        class=" nav-link {{Request::is('kurikulum')?'active':''}} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Kurikulum</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('kurikulum.create')}}"
                                        class="nav-link {{Request::is('kurikulum/create')?'active':''}} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Kurikulum</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview {{Request::is('dosen')?'menu-open':''}} {{Request::is('dosen/create')?'menu-open':''}}">
                            <a href="#" class="nav-link  ">
                                <i class="nav-icon fas fa-chalkboard-teacher "></i>
                                <p class="text ">
                                    DOSEN
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('dosen.index')}}"
                                        class="nav-link {{Request::is('dosen')?'active':''}} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Dosen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('dosen.create')}}"
                                        class="nav-link {{Request::is('dosen/create')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Dosen</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview {{Request::is('kelas')?'menu-open':''}} {{Request::is('kelas/create')?'menu-open':''}}">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon far fas fa-cube"></i>
                                <p class="text ">
                                    KELAS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('kelas.index')}}"
                                        class="nav-link {{Request::is('kelas')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('kelas.create')}}"
                                        class="nav-link {{Request::is('kelas/create')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Kelas</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview {{Request::is('matkul')?'menu-open':''}} {{Request::is('matkul/create')?'menu-open':''}}">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-book-open"></i>
                                <p class="text ">
                                    MATA KULIAH
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('matkul.index')}}"
                                        class="nav-link {{Request::is('matkul')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Mata Kuliah</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('matkul.create')}}"
                                        class="nav-link {{Request::is('matkul/create')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Input Mata Kuliah</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview {{Request::is('sebaran')?'menu-open':''}} {{Request::is('sebaran/kurikulum_2014_ganjil')?'menu-open':''}} {{Request::is('sebaran/kurikulum_2014_genap')?'menu-open':''}} {{Request::is('sebaran/kurikulum_2019_ganjil')?'menu-open':''}} {{Request::is('sebaran/kurikulum_2019_genap')?'menu-open':''}} {{Request::is('sebaran/create')?'menu-open':''}}">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon far fa-copy"></i>
                                <p class="text ">
                                    SEBARAN
                                    <i class="right fas fa-angle-left"></i>
                                    @if(Auth::user()->level == 'admin')
                                    <?php $status = App\Sebaran::where('approved','0')->count(); ?>
                                    <span class="badge badge-danger right">
                                        {{$status}}
                                    </span>
                                    @endif
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('sebaran.index')}}"
                                        class="nav-link {{Request::is('sebaran')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Sebaran</p>
                                    </a>
                                </li>
                                @if(Auth::user()->level == 'prodi')
                                <li class="nav-item has-treeview menu-open">
                                    <a href="#"
                                        class="nav-link {{Request::is('sebaran')?'menu-open':''}} {{Request::is('sebaran/kurikulum_2014_ganjil')?'menu-open':''}} ">
                                        <i class="far fa-circle nav-icon "></i>
                                        <p>Input Sebaran</p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                            <a href="{{ route('sebaran.create')}}" class="nav-link {{Request::is('sebaran/create')?'active':''}}">
                                                <i class="far fa-dot-circle nav-icon  "></i>
                                                <p>Sebaran / Kelas</p>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a href="{{ route('sebaran.create_kur2014_ganjil')}}" class="nav-link {{Request::is('sebaran/kurikulum_2014_ganjil')?'active':''}}">
                                                <i class="far fa-dot-circle nav-icon  "></i>
                                                <p>Kurikulum 2014 - Ganjil</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('sebaran.create_kur2014_genap')}}" class="nav-link {{Request::is('sebaran/kurikulum_2014_genap')?'active':''}}">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Kurikulum 2014 - Genap</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('sebaran.create_kur2019_ganjil')}}" class="nav-link {{Request::is('sebaran/kurikulum_2019_ganjil')?'active':''}}">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Kurikulum 2019 - Ganjil</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('sebaran.create_kur2019_genap')}}" class="nav-link {{Request::is('sebaran/kurikulum_2019_genap')?'active':''}}">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>Kurikulum 2019 - Genap</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @if(Auth::user()->level == 'admin')
                        <li class="nav-item has-treeview {{Request::is('rekap')?'menu-open':''}}">
                            <a href="#" class="nav-link  ">
                                <i class="nav-icon ion ion-stats-bars "></i>
                                <p class="text ">
                                    REKAPITULASI
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('rekap.index')}}"
                                        class="nav-link {{Request::is('rekap')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rekap Dosen</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->level == 'admin')
                        <li
                            class="nav-item has-treeview {{Request::is('users')?'menu-open':''}} {{Request::is('users/create')?'menu-open':''}} ">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-users"></i>
                                <p class="text ">
                                    USERS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.index')}}"
                                        class="nav-link {{Request::is('users')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.create')}}"
                                        class="nav-link {{Request::is('users/create')?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create User</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endif


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
                        <div class="col-sm-12 text-center">
                            <h1 class="m-0 text-dark">@yield('title')</h1>
                        </div><!-- /.col -->

                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>


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
    <script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#hapus').on('click', function () {
                let url = $(this).data('url')
                console.log(url)
            })
        })

    </script>

    </script>
    <script>
        $(document).ready(function () {
            $('#matkul').DataTable({
                order: [
                    [5, 'asc']
                ],
                rowGroup: {
                    dataSrc: 5
                }
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('').DataTable({
                order: [
                    [1, 'asc']
                ],
                rowGroup: {
                    dataSrc: 1
                }
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            $('#prodi').DataTable({
                dom: 'Bfrtip',
                buttons: [

                ]
            });
        });

    </script>

    <script>
        $(document).ready(function () {
            $('#kelas ').DataTable({


            });
        });

    </script>
    <script>
        $(document).ready(function () {
            $('#dosen ').DataTable({
            });
            $('#show_dosen ').DataTable({
            });
        });

    </script>
    <script>
        $(document).ready(function () {
            $('.sebaran').DataTable({
             
               
            });
        });

    </script>
    <script>
        $(document).ready(function () {
            $('.users').DataTable({
                dom: 'Bfrtip',
                buttons: [

                ]
            });
        });

    </script>
</body>

</html>
