
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    @php
      $locale = app()->getLocale();
      $language_keys = array_keys(\LaravelLocalization::getSupportedLocales());
    @endphp

    <div class="navbar-custom-menu ml-auto">
      <ul class="nav navbar-nav">

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown language-menu">
          <a href="#" data-toggle="dropdown">
            <span class="hidden-xs"><span class="flag {{ $locale }}" style="margin-top: 0 !important;"></span>
            
          </span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            @foreach ($language_keys as $key => $code)
                @if ($code == $locale)
                  <li><div class="flag {{ $locale }}">[{{$code}}]</div></li>
                @else
                <li><a href="{{ LaravelLocalization::getLocalizedURL($code) }}"><div class="flag {{ $code }}">[{{$code}}]</div></a></li>
                @endif
            @endforeach
            <!-- Menu Body -->
            <!-- <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Friends</a>
                </div>
              </div>
            </li> -->
            <!-- Menu Footer-->

          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">

          
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="img-circle elevation-2 sidebar-user" style="display: inline-block">
              <i class="fa fa-user"></i>
              </div>
            <span class="hidden-xs">{{ auth()->user()->firstname." ".auth()->user()->lastname }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <i class="fa fa-user"></i>

              <p>
                {{ auth()->user()->firstname." ".auth()->user()->lastname }}
                <small>{{ auth()->user()->email }}</small>
              </p>
            </li>
            <!-- Menu Body -->
            
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="float-left">
                <a href="{{ route('profile') }}" class="btn btn-primary btn-flat"><i class="fa fa-user" aria-hidden="true"></i> {{trans('translate.profile') }}</a>
              </div>
              <div class="float-right">
                <a href="{{ route('admin.logout') }}" class="btn btn-secondary btn-flat"><i class="fas fa-power-off"></i> {{trans('translate.logout') }}</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>
</nav>
