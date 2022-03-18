@extends('front::layouts.master')

@section('content')

  <!-- Navbar -->
  <div class="navbar navbar-expand-lg navbar-dark sticky" data-offset="500">

    @php
        $locale = App::currentLocale();
        if( $locale == "en" ) { $localeText = "Engish"; }
        else if( $locale == "hu" ) { $localeText = "Magyar"; }
        else if( $locale == "sr" ) { $localeText = "Srpski"; }
        else { $localeText = "Srpski"; }
    @endphp

    <div class="container">

      <a href="/" class="navbar-brand"><img src="{{ asset('./images/abacus_logo.jpg') }}" alt="Abacus Rex" height="40px"></a>
          
      <button class="navbar-toggler" data-toggle="collapse" data-target="#main-navbar" aria-expanded="true">
        <span class="ti-menu"></span>
      </button>

      <div class="collapse navbar-collapse" id="main-navbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="{{ route('page.esfinx') }}" class="nav-link" data-animate="scrolling">eSFinx paket</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('page.budzetski') }}" class="nav-link" data-animate="scrolling">Budzetski paket</a>
          </li>
          <li class="nav-item active">
            <a href="{{ route('page.vodovod') }}" class="nav-link" data-animate="scrolling">Vodovod paket</a>
          </li>
        </ul>

        <div class="dropdown">
          <button class="dropbtn"> {{ $localeText }} </button>
          <div class="dropdown-content">
            <a href="/en">English</a>
            <a href="/sr">Srpski</a>
            <a href="/hu">Magyar</a>
          </div>
        </div>

      </div>

    </div>
    
  </div> <!-- End Navbar -->

    <!-- Caption header -->
    <div class="vg-page page-home" id="home" style="background-image: url(./images/header.jpg)">
      <div class="caption-header text-center wow zoomInDown">
        <h1 class="fw-light mb-4"> <b class="fg-theme">Vodovod paket</b> </h1>
        <div class="badge">INNOVATIVE TECHNOLOGY</div>
      </div> 
      <div class="floating-button"><span class="ti-mouse"></span></div>
    </div> <!-- End Caption header -->

  <div class="esfinx-header">
    Buzetski
  </div>

  <h1>Budzetski</h1>

@endsection