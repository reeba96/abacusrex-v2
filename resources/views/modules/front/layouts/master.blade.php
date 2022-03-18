<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <title>Abacus Rex</title>
      <link rel="shortcut icon" href="{{ asset('./images/icons/abacus_icon.png') }}" type="image/x-icon">

      {{-- CSS --}}
      <link rel="stylesheet" type="text/css" href="{{ asset('./css/front.css') }}">
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
        
      @yield('content')

      <!-- Footer -->
      <div class="vg-footer">

        <div class="container">
          <div class="row">

            <div class="col-lg-4 py-3">
              <div class="footer-info">
                <p>O nama</p>
                <hr class="divider">
                <p class="fs-large fg-white">
                  Društvo za informatički inžinjering Abacus Rex se bavi razvojem softvera za knjigovodstvo i automatizaciju kancelarajiskog 
                  poslovanja, a ima višedecenijsko iskustvo i u razvoju softvera za građevinarstvo i zdravstvo.
                </p>
              </div>
            </div>

            <div class="col-lg-3 py-3">
              <div class="footer-info">
                <p>Lokacija</p>
                <hr class="divider">
                <p class="fs-large fg-white">
                  Srbija, <br> 24000 Subotica, Požarevaćka 3.
                </p>
              </div>
            </div>

            <div class="col-lg-2 py-3">
              <div class="float-lg-right">
                <p>Društvene mreže</p>
                <hr class="divider">
                <ul class="list-unstyled">
                  <li><a href="#">Facebook</a></li>
                  <li><a href="#">Skype</a></li>
                  <li><a href="#">Instagram</a></li>
                  <li><a href="#">Youtube</a></li>
                </ul>
              </div>
            </div>

            <div class="col-lg-3 py-3">
              <div class="float-lg-right">
                <p>Više informacija</p>
                <hr class="divider">
                <ul class="list-unstyled">
                  <li>Abacus Rex D.O.O.</li>
                  <li>reebgabor@abacusrex.rs</li>
                  <li>+381 (0)63/8527-922</li>
                  <li>PIB: 104097374</li>
                  <li>MBR: 08458871</li>
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
              <p class="text-center mb-0 mt-4">Copyright &copy;2022. All right reserved</a></p>
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