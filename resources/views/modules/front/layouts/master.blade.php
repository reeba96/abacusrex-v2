<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Abacus Rex</title>

        {{-- CSS --}}
        <link rel="shortcut icon" href="{{ asset('./images/icons/abacus_icon.png') }}" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="/front/css/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="/front/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/front/vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="/front/vendor/owl-carousel/owl.carousel.css">
        {{-- <link rel="stylesheet" type="text/css" href="/front/vendor/perfect-scrollbar/css/perfect-scrollbar.css"> --}}
        <link rel="stylesheet" type="text/css" href="/front/vendor/nice-select/css/nice-select.css">
        <link rel="stylesheet" type="text/css" href="front/vendor/fancybox/css/jquery.fancybox.min.css">
        <link rel="stylesheet" type="text/css" href="/front/css/virtual.css">
        <link rel="stylesheet" type="text/css" href="/front/css/topbar.virtual.css">

    </head>

    <body class="theme-red">
  
        <div class="vg-page page-home" id="home" style="background-image: url(./images/header.jpg)">
            <!-- Navbar -->
            <div class="navbar navbar-expand-lg navbar-dark sticky" data-offset="500">

                <div class="container">
                    <a href="/" class="navbar-brand"><img src="{{ asset('./images/abacus_logo.jpg') }}" alt="Abacus Rex" height="40px"></a>
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#main-navbar" aria-expanded="true">
                        <span class="ti-menu"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="main-navbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                              <a href="#about" class="nav-link" data-animate="scrolling">O nama</a>
                            </li>
                            <li class="nav-item">
                              <a href="#eSFinx" class="nav-link" data-animate="scrolling">eSFinx paket</a>
                            </li>
                            <li class="nav-item">
                              <a href="#portfolio" class="nav-link" data-animate="scrolling">Budzetski paket</a>
                            </li>
                            <li class="nav-item">
                              <a href="#contact" class="nav-link" data-animate="scrolling">Contact</a>
                            </li>
                        </ul>
                        <ul class="nav ml-auto">
                            <li class="nav-item">
                            <button class="btn btn-fab btn-theme no-shadow">En</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- End Navbar -->

            <!-- Caption header -->
            <div class="caption-header text-center wow zoomInDown">
                <h5 class="fw-normal">Welcome</h5>
                <h1 class="fw-light mb-4"><b class="fg-theme">Abacus</b> Rex</h1>
                <div class="badge">INNOVATIVE TECHNOLOGY</div>
            </div> <!-- End Caption header -->
            
            <div class="floating-button"><span class="ti-mouse"></span></div>

        </div>
        
        @yield('content')

        <!-- Footer -->
  <div class="vg-footer">
    <h1 class="text-center">Virtual Folio</h1>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 py-3">
          <div class="footer-info">
            <p>Where to find me</p>
            <hr class="divider">
            <p class="fs-large fg-white">1600 Amphitheatre Parkway Mountain View, California 94043 US</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 py-3">
          <div class="float-lg-right">
            <p>Follow me</p>
            <hr class="divider">
            <ul class="list-unstyled">
              <li><a href="#">Instagram</a></li>
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Youtube</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 py-3">
          <div class="float-lg-right">
            <p>Contact me</p>
            <hr class="divider">
            <ul class="list-unstyled">
              <li>info@virtual.com</li>
              <li>+8890234</li>
              <li>+813023</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mt-3">
        <div class="col-12 mb-3">
          <h3 class="fw-normal text-center">Subscribe</h3>
        </div>
        <div class="col-lg-6">
          <form class="mb-3">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Email address">
              <input type="submit" class="btn btn-theme no-shadow" value="Subscribe">
            </div>
          </form>
        </div>
        <div class="col-12">
          <p class="text-center mb-0 mt-4">Copyright &copy;2020. All right reserved | This template is made with <span class="ti-heart fg-theme-red"></span> by <a href="https://www.macodeid.com/">MACode ID</a></p>
        </div>
      </div>
    </div>
  </div> <!-- End footer -->

        <script src="/front/js/jquery-3.5.1.min.js"></script>
        <script src="/front/js/bootstrap.bundle.min.js"></script>
        <script src="/front/vendor/owl-carousel/owl.carousel.min.js"></script>
        {{-- <script src="/front/vendor/perfect-scrollbar/js/perfect-scrollbar.js"></script> --}}
        <script src="/front/vendor/isotope/isotope.pkgd.min.js"></script>
        <script src="/front/vendor/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="/front/vendor/fancybox/js/jquery.fancybox.min.js"></script>
        <script src="/front/vendor/wow/wow.min.js"></script>
        <script src="/front/vendor/animateNumber/jquery.animateNumber.min.js"></script>
        <script src="/front/vendor/waypoints/jquery.waypoints.min.js"></script>
        <script src="/front/js/google-maps.js"></script>
        <script src="/front/js/topbar-virtual.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA_zqjFMsJM_sxP9-6Pde5vVCTyJmUHM&callback=initMap"></script>
  
    </body>
</html>
