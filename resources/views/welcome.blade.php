<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SISTAKU</title>

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
    
      <div class="logo mr-auto">
        
      <h1 class="text-light"><a href="{{ url('/home') }}">Sistaku<span>.</span></a></h1>
      
      </div>
      
      <nav class="nav-menu d-none d-lg-block">
        <ul>
        @if (Route::has('login'))
        @auth
        @else
        <li class="get-started"><a href="{{ route('login') }}">Login</a></li>
        <!-- @if (Route::has('register'))
        <li class="get-started"><a href="{{ route('register') }}">Register</a></li> -->
        </ul>
      </nav><!-- .nav-menu -->
    <!-- @endif -->
    @endauth
    @endif
    </div>
  </header><!-- End Header -->
    <section id="hero">

        <div class="container">
            <div class="row d-flex align-items-center"">
  <div class=" col-lg-6 py-5 py-lg-0 order-2 order-lg-1" data-aos="fade-right">
                <h1 class="text-center"> SISTAKU</h1>
                <h2 class="text-center"> Sistem Informasi Penentuan Dosen Pengampu Mata Kuliah</h2>
                
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
                <img src="{{ asset('assets/img/hero-img.png')}}" class="img-fluid" alt="">
            </div>
        </div>
        </div>

    </section><!-- End Hero -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/venobox/venobox.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js')}}"></script>
</body>

</html>
