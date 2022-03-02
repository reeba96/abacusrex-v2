@extends('front::layouts.master')

@section('content')

<div class="vg-page page-about" id="about">
  <div class="container pt-5">
    <div class="row">
      <div class="col-md-6 wow fadeInRight">
        <h2 class="fw-normal">Education</h2>
        <ul class="timeline mt-4 pr-md-5">
          <li>
            <div class="title">2010</div>
            <div class="details">
              <h5>Specialize of course</h5>
              <small class="fg-theme">University of Study</small>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered</p>
            </div>
          </li>
          <li>
            <div class="title">2009</div>
            <div class="details">
              <h5>Specialize of course</h5>
              <small class="fg-theme">University of Study</small>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered</p>
            </div>
          </li>
          <li>
            <div class="title">2008</div>
            <div class="details">
              <h5>Specialize of course</h5>
              <small class="fg-theme">University of Study</small>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered</p>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-md-6 wow fadeInRight" data-wow-delay="200ms">
        <h2 class="fw-normal">Experience</h2>
        <ul class="timeline mt-4 pr-md-5">
          <li>
            <div class="title">2017 - Current</div>
            <div class="details">
              <h5>Specialize of course</h5>
              <small class="fg-theme">University of Study</small>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered</p>
            </div>
          </li>
          <li>
            <div class="title">2014</div>
            <div class="details">
              <h5>Specialize of course</h5>
              <small class="fg-theme">University of Study</small>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered</p>
            </div>
          </li>
          <li>
            <div class="title">2011</div>
            <div class="details">
              <h5>Specialize of course</h5>
              <small class="fg-theme">University of Study</small>
              <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>


  <!-- Services -->
  <div class="vg-page page-service">
    <div class="container">

      <div class="text-center wow fadeInUp">
        <div class="badge badge-subhead">Usluge</div>
      </div>

      <h1 class="fw-normal text-center wow fadeInUp">Čime se bavimo?</h1>

      <div class="row mt-5">

        <div class="col-md-6 col-lg-4 col-xl-3">
          <div class="card card-service wow fadeInUp">
            <div class="icon">
              <span class="ti-bar-chart"></span>
            </div>
            <div class="caption">
              <h4 class="fg-theme">Knjigovodstvo</h4>
              <p>There are many variations of passages of Lorem Ipsum available</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-3">
          <div class="card card-service wow fadeInUp">
            <div class="icon">
              <span class="ti-cloud"></span>
            </div>
            <div class="caption">
              <h4 class="fg-theme">Vodovod</h4>
              <p>There are many variations of passages of Lorem Ipsum available</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-3">
          <div class="card card-service wow fadeInUp">
            <div class="icon">
              <span class="ti-search"></span>
            </div>
            <div class="caption">
              <h4 class="fg-theme">SEO</h4>
              <p>There are many variations of passages of Lorem Ipsum available</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-3">
          <div class="card card-service wow fadeInUp">
            <div class="icon">
              <span class="ti-desktop"></span>
            </div>
            <div class="caption">
              <h4 class="fg-theme">Web Development</h4>
              <p>There are many variations of passages of Lorem Ipsum available</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div> <!-- End services -->

</div>

<div class="vg-page page-funfact" id="eSFinx" style="background-image: url(../assets/img/bg_banner.jpg);">
  <div class="container">
    <div class="row section-counter">
      <div class="col-md-6 col-lg-3 py-4 wow fadeIn">
        <h1 class="number" data-number="27">27</h1>
        <span>Postojanje</span>
      </div>
      <div class="col-md-6 col-lg-3 py-4 wow fadeIn">
        <h1 class="number" data-number="99">99</h1>
        <span>Klienti</span>
      </div>
      <div class="col-md-6 col-lg-3 py-4 wow fadeIn">
        <h1 class="number" data-number="50">50</h1>
        <span>Iskustvo</span>
      </div>
      <div class="col-md-6 col-lg-3 py-4 wow fadeIn">
        <h1 class="number" data-number="9">9</h1>
        <span>Tehnologije</span>
      </div>
    </div>
  </div>
</div>

<!-- Portfolio page -->
<div class="vg-page page-portfolio" id="portfolio">
  <div class="container">
    <div class="text-center wow fadeInUp">
      <div class="badge badge-subhead">Portfolio</div>
    </div>
    <h1 class="text-center fw-normal wow fadeInUp">See my work</h1>
    <div class="filterable-button py-3 wow fadeInUp" data-toggle="selected">
      <button class="btn btn-theme-outline selected" data-filter="*">All</button>
      <button class="btn btn-theme-outline" data-filter=".apps">Apps</button>
      <button class="btn btn-theme-outline" data-filter=".template">Template</button>
      <button class="btn btn-theme-outline" data-filter=".ios">IOS</button>
      <button class="btn btn-theme-outline" data-filter=".ui-ux">UI/UX</button>
      <button class="btn btn-theme-outline" data-filter=".graphic">Graphic</button>
      <button class="btn btn-theme-outline" data-filter=".wireframes">Wireframes</button>
    </div>

    <div class="gridder my-3">
      <div class="grid-item apps wow zoomIn">
        <div class="img-place" data-src="../assets/img/work/work-1.jpg" data-fancybox data-caption="<h5 class='fg-theme'>Mobile Travel App</h5> <p>Travel, Discovery</p>">
          <img src="../assets/img/work/work-1.jpg" alt="">
          <div class="img-caption">
            <h5 class="fg-theme">Mobile Travel App</h5>
            <p>Travel, Discovery</p>
          </div>
        </div>
      </div>
      <div class="grid-item template wireframes wow zoomIn">
        <div class="img-place" data-src="../assets/img/work/work-2.jpg" data-fancybox data-caption="<h5 class='fg-theme'>Music App</h5> <p>Musics</p>">
          <img src="../assets/img/work/work-2.jpg" alt="">
          <div class="img-caption">
            <h5 class="fg-theme">Music App</h5>
            <p>Musics</p>
          </div>
        </div>
      </div>
      <div class="grid-item apps ios wow zoomIn">
        <div class="img-place" data-src="../assets/img/work/work-3.jpg" data-fancybox data-caption="<h5 class='fg-theme'>Gaming Dashboard</h5> <p>Games, Streaming</p>">
          <img src="../assets/img/work/work-3.jpg" alt="">
          <div class="img-caption">
            <h5 class="fg-theme">Gaming Dashboard</h5>
            <p>Games, Streaming</p>
          </div>
        </div>
      </div>
      <div class="grid-item graphic ui-ux wow zoomIn">
        <div class="img-place" data-src="../assets/img/work/work-4.jpg" data-fancybox data-caption="<h5 class='fg-theme'>Drugs Delivery App</h5> <p>Health, Drugs</p>">
          <img src="../assets/img/work/work-4.jpg" alt="">
          <div class="img-caption">
            <h5 class="fg-theme">Drugs Delivery App</h5>
            <p>Health, Drugs</p>
          </div>
        </div>
      </div>
      <div class="grid-item apps ios wow zoomIn">
        <div class="img-place" data-src="../assets/img/work/work-5.jpg" data-fancybox data-caption="<h5 class='fg-theme'>Musics Discover</h5> <p>Musics, Dashboard</p>">
          <img src="../assets/img/work/work-5.jpg" alt="">
          <div class="img-caption">
            <h5 class="fg-theme">Musics Discover</h5>
            <p>Musics, Dashboard</p>
          </div>
        </div>
      </div>
      <div class="grid-item graphic ui-ux wireframes wow zoomIn">
        <div class="img-place" data-src="../assets/img/work/work-6.jpg" data-fancybox data-caption="<h5 class='fg-theme'>Game Streaming</h5> <p>Games, Streaming</p>">
          <img src="../assets/img/work/work-6.jpg" alt="">
          <div class="img-caption">
            <h5 class="fg-theme">Game Streaming</h5>
            <p>Games, Streaming</p>
          </div>
        </div>
      </div>
    </div> <!-- End gridder -->
    <div class="text-center wow fadeInUp">
      <a href="javascript:void(0)" class="btn btn-theme">Load More</a>
    </div>
  </div>
</div> <!-- End Portfolio page -->



<!-- Portfolio -->
<div class="vg-page page-client">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp logo-div">
          <img class="hometrend-logo" src="front/img/portfolio/hometrend.png" alt="HomeTrend">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp logo-div">
          <img class="vodovod-logo" src="front/img/portfolio/vodovod_logo.png" alt="Vodovod Bezdan">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp logo-div">
          <img class="fruit-land-logo" src="front/img/portfolio/fruit_land.png" alt="Fruit Land">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp logo-div">
          <img class="agrooprema-logo" src="front/img/portfolio/agrooprema.png" alt="Agrooprema">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp logo-div">
          <img class="decorex-logo" src="front/img/portfolio/decorex.png" alt="Decorex">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp logo-div">
          <img class="sopro-logo" src="front/img/portfolio/sopro.png" alt="Sopro">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp logo-div">
          <img class="mnt-logo" src="front/img/portfolio/mnt.png" alt="MNT">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp logo-div">
          <img class="dz-logo" src="front/img/portfolio/dz.png" alt="Dom Zdravlja">
        </div>
      </div>
    </div>
  </div>
</div> <!-- End portfolio -->

<!-- Contact -->
<div class="vg-page page-contact" id="contact">
  <div class="container-fluid">

    <div class="text-center wow fadeInUp">
      <div class="badge badge-subhead">Kontakt</div>
    </div>

    <h1 class="text-center fw-normal wow fadeInUp">Kontaktirajte Nas</h1>

    <div class="row py-5">

      <div class="col-lg-7 px-0 pr-lg-3 wow zoomIn">
        <div class="vg-maps">
          <div id="google-maps" style="width: 100%; height: 100%;"></div>
        </div>
      </div>

      <div class="col-lg-5">
        <form class="vg-contact-form">
          <div class="form-row">
            <div class="col-12 mt-3 wow fadeInUp">
              <input class="form-control" type="text" name="Name" placeholder="Ime">
            </div>
            <div class="col-6 mt-3 wow fadeInUp">
              <input class="form-control" type="text" name="Email" placeholder="Email">
            </div>
            <div class="col-6 mt-3 wow fadeInUp">
              <input class="form-control" type="text" name="Subject" placeholder="Naslov">
            </div>
            <div class="col-12 mt-3 wow fadeInUp">
              <textarea class="form-control" name="Message" rows="6" placeholder="Poruka..."></textarea>
            </div>
            <button type="submit" class="btn btn-theme mt-3 wow fadeInUp ml-1">Pošalji</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div> <!-- End Contact -->
@endsection
