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
          <li class="nav-item active">
            <a href="{{ route('page.esfinx') }}" class="nav-link" data-animate="scrolling">eSFinx paket</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('page.budzetski') }}" class="nav-link" data-animate="scrolling">Budzetski paket</a>
          </li>
          <li class="nav-item">
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
      <h1 class="fw-light mb-4"> <b class="fg-theme">esFinx paket</b> </h1>
      <div class="badge">INNOVATIVE TECHNOLOGY</div>
    </div> 
    <div class="floating-button"><span class="ti-mouse"></span></div>
  </div> <!-- End Caption header -->

  <div class="container-esfnix">
    
    <div class="row esfinx-description">
      <div class="col-lg-12">
        Robno knjigovodstvo: kalkulacije, fakturisanje, rabat sistem, kase, uvoz-izvoz, zalihe, KEP
        Glavna knjiga: kupci-dobavljači, IOS, import izvoda, zaključni list, kompenzacije
        Obračun zarada: redovan rad, beneficije, porodiljstva, bolovanja, ugovori o delu, PPPPD
        Osnovna sredstva: amortizacije, po kontima, po grupama, po analitici, po mestima troška
        Radni nalozi: predatnica sirovine, prijem gotovog proizvoda, knjiženje po normativu
        Putni nalozi: dnevnice po dolasku i odlasku, obračun sopstvenog vozila (din/km)
      </div>
    </div>

    <div class="row esfinx-points">
      <div class="col-lg-6">
        <ul class="esfinx-ul">
          <li>
            <span class="ti-hand-point-right"></span>
            25 godina razvoja - paket je besplatan
          </li>
          <li>
            <span class="ti-hand-point-right"></span>
            Pločice dokumenata na početnom ekranu
          </li>
          <li>
            <span class="ti-hand-point-right"></span>
            Narudžbenice prema zadnjoj nabavci i prodaji
          </li>
          <li>
            <span class="ti-hand-point-right"></span>
            Export/Import (NBS,HALCOM,FxClient,eSPP)
          </li>
          <li>
            <span class="ti-hand-point-right"></span>
            Štampa barkodova/deklaracija za svaki artikal
          </li>
          <li>
            <span class="ti-hand-point-right"></span>
            Automatske nivelacije (KEP uvek u ravnoteži)
          </li>
          <li>
            <span class="ti-hand-point-right"></span>
            Zatezne kamate za plaćanje van valuta
          </li>
          <li>
            <span class="ti-hand-point-right"></span>
            Statistika prodaje po programu, artiklu i kupcu
          </li>
          <li>
            <span class="ti-hand-point-right"></span>
            Besplatni Libre Office je integralni deo paketa
          </li>
        </ul>
      </div>

      <div class="col-lg-6">
        
      </div>
    </div>

  </div>

@endsection