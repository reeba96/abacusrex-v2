@php
  $locale = app()->getLocale();
  $email = auth()->user()->email;
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="header">
      <a href="#" style="height: 75px" class="brand-link text-center">
        <img src="/images/icbtech_logo.png"  alt="Logo" class="w-80 brand-image">
      </a>
    </div>
    <div class="sidebar">
      <!-- Sidebar user panel -->

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="margin-left: 8px;">
        <div class="image">
		  	  <div class="img-circle elevation-2 sidebar-user">
				    <i class="fa fa-user"></i>
		  	  </div>
        </div>
        <div class="info">
          <a href="{{ route('profile') }}" class="d-block" style="margin-top: -3px;">{{ auth()->user()->firstname." ".auth()->user()->lastname }}</a>
        </div>
      </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a class="nav-link {{ Request::is($locale.'/admin/dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}">
              <i class="nav-icon fa fa-home"></i>
              <p>{{trans('translate.home') }}</p>
            </a>
          </li>

{{--
          <li class="nav-item">
            <a class="nav-link {{ Request::is($locale.'/admin/pages') ? 'active' : ''}}" href="{{ route('pages') }}">
              <i class="nav-icon fa fa-home"></i>
              <p>CMS</p>
            </a>
          </li>--}}


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  {{trans('translate.access') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview ml-4"
            style="display:{{ Request::is($locale.'/admin/access*') && !Request::is($locale.'/admin/access/user*') ? 'block' : 'none'}};">

              <li class="nav-item">
                <a href="{{ route('roles.role.index') }}" class="nav-link {{ Request::is($locale.'/admin/access/roles*') ? 'active' : ''}}">
                  <i class="fas fa-user-tag nav-icon"></i>
                  <p>{{trans('translate.roles') }}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('permissions.permission.index') }}" class="nav-link {{ Request::is($locale.'/admin/access/permissions*') ? 'active' : ''}}">
                  <i class="fas fa-project-diagram nav-icon"></i>
                  <p>{{trans('translate.permissions') }}</p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="{{ route('users.user.index') }}" class="nav-link {{ Request::is($locale.'/admin/access/users*') ? 'active' : ''}}">
                  <i class="far fa fa-users nav-icon"></i>
                  <p>{{trans('translate.users') }}</p>
                </a>
              </li> -->

              <li class="nav-item">
                <a href="{{ route('countries.country.index') }}" class="nav-link {{ Request::is($locale.'/admin/access/countries*') ? 'active' : ''}}">
                  <i class="far fa fa-map-marked  nav-icon"></i>
                  <p>{{trans('translate.countries') }}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('invitations.invitation.index') }}" class="nav-link {{ Request::is($locale.'/admin/access/invitations*') ? 'active' : ''}}">
                  <i class="fas fa-glass-cheers nav-icon"></i>
                  <p>{{trans('translate.invitations') }}</p>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link {{ Request::is($locale.'/admin/access/user-logs*') ? 'active' : ''}}" href="{{ route('access.user.logs') }}">
                  <i class="nav-icon far fa-list-alt"></i>
                  <p>{{trans('translate.user_logs') }}</p>
                </a>
              </li>

            </ul>

          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                {{ __('translate.settings') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview ml-4" style="display:{{ Request::is($locale.'/admin/settings*') ||  Request::is($locale.'/admin/settings*') ? 'block' : 'none'}};">
              <li class="nav-item">
                <a href="{{ route('settings') }}" class="nav-link {{ Request::is($locale.'/admin/settings/settings*') ? 'active' : ''}}">
                  <i class="fa fa-cog nav-icon" aria-hidden="true"></i>
                  <p>{{trans('translate.settings') }}</p>
                </a>
              </li>

              {{--
              <li class="nav-item">
                <a href="{{ route('mailables') }}" class="nav-link {{ Request::is($locale.'/admin/settings/mailables*') ? 'active' : ''}}">
                  <i class="fa fa-envelope nav-icon" aria-hidden="true"></i>
                  <p>{{trans('translate.mailables') }}</p>
                </a>
              </li>
              --}}

              <li class="nav-item">
                <a href="{{ route('templates') }}" class="nav-link {{ Request::is($locale.'/admin/settings/templates*') ? 'active' : ''}}">
                  <i class="fa fa-th-large nav-icon" aria-hidden="true"></i>
                  <p>{{trans('translate.templates') }}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('language_lines.language_lines.index') }}" class="nav-link {{ Request::is($locale.'/admin/settings/language_lines*') ? 'active' : ''}}">
                  <i class="fa fa-language nav-icon" aria-hidden="true"></i>
                  <p>{{trans('language_line.menu') }}</p>
                </a>
              </li>

            </ul>

          </li>
       {{--
          <li class="nav-item">
            <a class="nav-link {{ Request::is($locale.'/admin/PeopleCounter/emails') ? 'active' : ''}}" href="{{ route('PeopleCounter.email.index') }}">
              <i class="nav-icon fas fa-mail-bulk"></i>
              <p>{{trans('PeopleCounter.menu-emails') }}</p>
            </a>
          </li> --}}


          @role('admin')
          <li class="nav-item">
            <a class="nav-link {{ Request::is($locale.'/admin/modules') ? 'active' : ''}}" href="{{ route('modules') }}">
              <i class="nav-icon fas fa-puzzle-piece"></i>
              <p>{{trans('language_line.modules') }}</p>
            </a>
          </li>
          @endrole
        @php
          $cms_modules = \Modules\Admin\Entities\CmsModule::where('is_installed',1)->where('main_menu',1)->get();

        @endphp
        @if (  $cms_modules && $cms_modules->count() > 0)
            @foreach ($cms_modules as $cms_module)
              {!! \App::call('\Modules\\' . $cms_module->name . '\Http\Controllers\InstallController@get_main_menu'); !!}
            @endforeach
        @endif

        <li class="header"></li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}">
                <i class="nav-icon fas fa-sign-out-alt text-red"></i>
                <p>{{trans('translate.logout') }}</p>
            </a>
        </li>
        <!-- text-yellow
        text-aqua -->
      </ul>
    </nav>
    </div>
    <!-- /.sidebar -->
  </aside>
