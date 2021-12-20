@extends('front::layouts.master')

@section('content')

<div class="vg-page page-about" id="about">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4 py-3">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/person.jpg" alt="">
        </div>
      </div>
      <div class="col-lg-6 offset-lg-1 wow fadeInRight">
        <h1 class="fw-light">Stephen Doe</h1>
        <h5 class="fg-theme mb-3">UI/UX & Web Designer</h5>
        <p class="text-muted">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form but the majority have suffered alteration in some</p>
        <ul class="theme-list">
          <li><b>From:</b> Texas, US</li>
          <li><b>Lives In:</b> Texas, US</li>
          <li><b>Age:</b> 25</li>
          <li><b>Gender:</b> Male</li>
        </ul>
        <button class="btn btn-theme-outline">Download CV</button>
      </div>
    </div>
  </div>
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
</div>

<div class="vg-page page-service">
  <div class="container">
    <div class="text-center wow fadeInUp">
      <div class="badge badge-subhead">Service</div>
    </div>
    <h1 class="fw-normal text-center wow fadeInUp">What can i do?</h1>
    <div class="row mt-5">
      <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="card card-service wow fadeInUp">
          <div class="icon">
            <span class="ti-paint-bucket"></span>
          </div>
          <div class="caption">
            <h4 class="fg-theme">Web Design</h4>
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
            <span class="ti-vector"></span>
          </div>
          <div class="caption">
            <h4 class="fg-theme">UI/UX Design</h4>
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
</div>

<div class="vg-page page-funfact" style="background-image: url(../assets/img/bg_banner.jpg);">
  <div class="container">
    <div class="row section-counter">
      <div class="col-md-6 col-lg-3 py-4 wow fadeIn">
        <h1 class="number" data-number="768">768</h1>
        <span>Clients</span>
      </div>
      <div class="col-md-6 col-lg-3 py-4 wow fadeIn">
        <h1 class="number" data-number="230">230</h1>
        <span>Project Compleate</span>
      </div>
      <div class="col-md-6 col-lg-3 py-4 wow fadeIn">
        <h1 class="number" data-number="97">97</h1>
        <span>Project Ongoing</span>
      </div>
      <div class="col-md-6 col-lg-3 py-4 wow fadeIn">
        <h1 class="number" data-number="699">699</h1>
        <span>Client Satisfaction</span>
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



<!-- Client -->
<div class="vg-page page-client">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/logo/company_1.svg" alt="">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/logo/company_2.svg" alt="">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/logo/company_3.svg" alt="">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/logo/company_4.svg" alt="">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/logo/company_5.svg" alt="">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/logo/company_6.svg" alt="">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/logo/company_7.svg" alt="">
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 item">
        <div class="img-place wow fadeInUp">
          <img src="../assets/img/logo/company_8.svg" alt="">
        </div>
      </div>
    </div>
  </div>
</div> <!-- End client -->

<!-- Contact -->
<div class="vg-page page-contact" id="contact">
  <div class="container-fluid">
    <div class="text-center wow fadeInUp">
      <div class="badge badge-subhead">Contact</div>
    </div>
    <h1 class="text-center fw-normal wow fadeInUp">Get in touch</h1>
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
              <input class="form-control" type="text" name="Name" placeholder="Your Name">
            </div>
            <div class="col-6 mt-3 wow fadeInUp">
              <input class="form-control" type="text" name="Email" placeholder="Email Address">
            </div>
            <div class="col-6 mt-3 wow fadeInUp">
              <input class="form-control" type="text" name="Subject" placeholder="Subject">
            </div>
            <div class="col-12 mt-3 wow fadeInUp">
              <textarea class="form-control" name="Message" rows="6" placeholder="Enter message here.."></textarea>
            </div>
            <button type="submit" class="btn btn-theme mt-3 wow fadeInUp ml-1">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> <!-- End Contact -->
@endsection
