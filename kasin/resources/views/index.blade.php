<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KASIN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('') }}assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('') }}assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="{{ asset('') }}css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navigation -->
  <section id="nav">
        <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top"> -->
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container">
              <a href="#" class="brand-link">
                  <img src="{{ asset('img/LogoK.png') }}" width="100" height="100" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                  <span class="brand-text font-weight-bold" style="color: #ffff00">Kas<span style="color: #00ffff">in</span></span>
                </a>
            {{-- <img src="{{ asset('') }}img/LogoK.png" class="ban-img img-fluid" alt="" height="50" width="50"> --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
              aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown" id="dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    TIM
                  </a>
                  <div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Alfian Muhamad Rizal Yuristya</a>
                    <a class="dropdown-item" href="#">Ayu Widiya Ningrum</a>
                    <a class="dropdown-item" href="#">Farhan Rasyid</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </section>

       <!-- Banner -->
  <section id="banner">
        <div class="banner">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <h4 class="title">Selamat Datang</h4>
                <p>Terima kasih telah mengunjungi website KASIN</p>
                <a href="/login" class="btn btn-warning"> LOG IN</a>
                <a href="/register" class="btn btn-success"> SIGN IN</a>
              </div>
              <div class="col-md-6">
                  <img src="{{ asset('') }}img/tima.png" alt="">
                <img src="re" class="ban-img img-fluid" alt="">
              </div>
            </div>
          </div>
        </div>

        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path fill="#fff" fill-opacity="1" d="M0,256L120,250.7C240,245,480,235,720,240C960,245,1200,267,1320,277.3L1440,288L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
        </svg>
       
      </section>
      <br>

  <section id="accordion">
    <div class="container">
      <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  About
                </button>
              </h2>
            </div>
        
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                KASIN adalah aplikasi yang memudahkan kamu dalam mengatur Uang Kas dalam suatu organisasi.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Visi
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                Visi KASIN adalah menjadi platform yang mudah digunakan dan kedepannya dapat mengembangkan fitur-fitur baru yang memudahkan suatu organisasi dalam melakukan tugasnya.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Misi
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                Misi KASIN yaitu untuk mendukung Indonesia maju dalam dunia digital.
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

</section>
<hr style="border-bottom : 1px solid blue">
<!-- footer -->
<section class="footer">
  <div class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">
          <address>
              <a href="#" class="brand-link">
                  <img src="{{ asset('img/LogoK.png') }}" width="100" height="100" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                  <span class="brand-text font-weight-bold" style="color: #ffff00">Kas<span style="color: #00ffff">in</span></span>
                </a>
            {{-- <img src="{{ asset('') }}img/kasin.png" class="img-fluid" alt="#">  --}}
          </address>
        </div>
        <div class="col-md-4">
          <address>
            <h5>HUBUNGI KAMI</h5>
            Jl. Raya Lenteng Agung No.20, RT.4/RW.1,<br /> Srengseng Sawah, Kec. Jagakarsa, Kota <br />Jakarta
            Selatan, DKI Jakarta 12640 <br /> E-mail: info@kasin.ac.id <br /><abbr title="Phone"></abbr> +62 857
            1624 3174
          </address>
        </div>
        
      </div>
    </div>
    <hr>
    <div class="foot">Copyright © 2021- KASIN</div>
  </div>
</section>


<!-- jQuery -->
<script src="{{ asset('') }}assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('') }}assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

@stack('script')
<!-- AdminLTE App -->
<script src="{{ asset('') }}assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('') }}assets/dist/js/demo.js"></script>

</body>
</html>