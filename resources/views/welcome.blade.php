<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- TAMPILAN AWAL SISTEM TEMPLATE BOCOR -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">


    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 0px;
        }

    </style>
</head>

<body>


    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container d-flex align-items-center">
        @if (Route::has('login'))
        @auth
            <div class="logo mr-auto">
                <h1 class="text-light"><a href="{{ url('/home') }}">SISTAKU<span>.</span></a></h1>
            </div>
            @else
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                     <li class="get-started"><a href="{{ route('login') }}">Login</a></li>
                </ul>
            </nav>
            @if (Route::has('register'))
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                     <li class="get-started"><a href="{{ route('register') }}">Register</a></li>
                </ul>
            </nav>
            @endif
            @endauth
        </div>
        @endif
    </header><!-- End Header -->
       <div class="flex-center position-ref full-height">     
            <div class="content">
                <div class="title m-b-md">
                    SISTAKU
                </div>

                <div>
                    Sistem Informasi Penentuan Dosen Pengampu Mata Kuliah
                </div>
            </div>
        </div>
</body>

</html>
