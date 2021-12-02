@extends('access::layouts.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('/theme/alteo/css/front.css') }}"></link>


<div class="sidenav">
    <!-- Just an image -->
    <nav class="navbar navbar-light ml-60">
        <a class="navbar-brand" href="#">
            <img src="/images/icbtech_logo.png" height="40" alt="">
        </a>
    </nav>
    <div class="login-main-text">
        <img src="" alt="">
        <div class="col-lg-10">
            <svg width="26" height="20" viewBox="0 0 26 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.9531 0.421875C23.0469 0.421875 23.5938 0.640625 23.5938 1.07812C23.5938 1.26562 23.4219 1.42187 23.0781 1.54688C20.2031 2.70313 18.7656 4.95313 18.7656 8.29688C19.2031 8.23438 19.5156 8.20312 19.7031 8.20312C23.4531 8.20312 25.3281 10.0781 25.3281 13.8281C25.3281 17.5469 23.4531 19.4062 19.7031 19.4062C15.3594 19.4062 13.1875 17.0156 13.1875 12.2344C13.1875 7.07812 15.2656 3.375 19.4219 1.125C20.2969 0.65625 21.1406 0.421875 21.9531 0.421875ZM9.71875 0.5625C10.8125 0.5625 11.3594 0.78125 11.3594 1.21875C11.3594 1.40625 11.1875 1.5625 10.8438 1.6875C7.96875 2.84375 6.53125 5.09375 6.53125 8.4375C6.96875 8.375 7.28125 8.34375 7.46875 8.34375C11.2188 8.34375 13.0938 10.2188 13.0938 13.9688C13.0938 17.6875 11.2188 19.5469 7.46875 19.5469C3.125 19.5469 0.953125 17.1562 0.953125 12.375C0.953125 7.21875 3.03125 3.51562 7.1875 1.26562C8.0625 0.796875 8.90625 0.5625 9.71875 0.5625Z" fill="#00AFCB"/>
            </svg>

            @php
                $locale = app()->getLocale();
                $article = \Modules\Admin\Entities\Article::getVisibleArticleByUrl('user','register');
                $field = 'content_'.$locale;
                $subtitle = 'subtitle_'.$locale;
            @endphp
            @if ($article)
                {!! $article->$field !!}
                <span>{{ $article->$subtitle}}</span>
            @endif
        </div>
    </div>
 </div>
 <div class="main">

    {{-- T&C --}}
    <div class="alert alert-primary forgot-password tac" role="alert">
        <a href="/files/GDPR_ALTE_GO.pdf" target="_blank">
            {{trans('translate.gdpr_footer') }}
        </a>
    </div>

    {{-- Language Selector --}}
    <div class="alert alert-primary lang-selector" role="alert">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown language-menu">
              <a href="#" data-toggle="dropdown">
                  <span class="hidden-xs">
                      <img src="" id="myImg">
                  </span>
              </a>
              <ul class="dropdown-menu" name="language" id="language-selector" style="padding: 15px;">
                  <li><div id="selected-language"></div></li>
                  <li><div id="english-language"><a href="/en/login">English</a></div></li>
                  <li><div id="hungarian-language"><a href="/hu/login">Magyar</a></div></li>
              </ul>
            </li>
          </ul>
    </div>

    {{-- GDPR --}}
    <div class="alert alert-primary forgot-password gdpr" role="alert">
        <a href="/files/T&C ALTE_GO.pdf" target="_blank">
            {{trans('translate.terms_footer') }}
        </a>
    </div>
    <div class="col-md-8 col-sm-12">
       <div class="login-form">
            <h2><b>{{trans('translate.register')}}</b></h2><br>

            <form method="POST" action="{{ route('postRegister') }}">
                {{ csrf_field() }}

                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group row">
                    <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ trans('translate.lastname') }}</label>

                    <div class="col-md-12">
                        <input type="text" class="form-control login-input @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ trans('translate.firstname') }}</label>

                    <div class="col-md-12">
                        <input type="text" class="form-control login-input @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('translate.password') }}</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control login-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-8 col-form-label text-md-right">{{ __('translate.confirm_pass') }}</label>

                    <div class="col-md-12">
                        <input id="password_confirmation" type="password" class="form-control login-input" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 offset-md-4"><br>
                        <label class="forgot-password" style="margin-top: 0 !important;">
                            <input type='checkbox' name="terms_conditions"> {{ __('translate.i_have_read_and_i_agree_to') }}
                            <a href="/files/GDPR_ALTE_GO.pdf" target="_blank">{{trans('translate.terms_footer') }}</a> &
                            <a href="/files/T&C ALTE_GO.pdf" target="_blank">{{trans('translate.gdpr_footer') }}</a>
                        </label>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-4"><br>
                        <button type="submit" id="registerButton" class="btn btn-theme col-lg-12 col-xs-12" disabled>{{ __('translate.register') }}</button>
                    </div>
                </div>

            </form>

          @if (config('access.can_register'))
            <div class="forgot-password">
                {{__('translate.have_account_login') }} <a href="{{ route ('login') }}">{{ trans('translate.login') }}</a>
            </div>
          @endif

          @include ('admin::admin.includes.message-block')

       </div>
    </div>
 </div>

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- include javascript, jQuery FIRST -->
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>


 <script>

    $('input[type="checkbox"]').change(function(){

        var checked = $('input[type="checkbox"]:checked').length;

        if(checked === 0){ $("#registerButton").prop('disabled',true); }
        else if(checked === 1){ $("#registerButton").prop('disabled',false); }
    });

 </script>

@endsection
