@extends('access::layouts.master')

@section('content')

<style>
    .btn-primary{
        border-color: #00AFCB !important;
        background-color: #00AFCB !important;
    }

    .btn-primary:hover{
        background-color: #0093ab !important
    }

    body{
        background: #151515 !important;
    }
</style>
<!-- Designed with ♥ by Frondor -->
<div class="container-fluid">
    <div class="row">
        <div class="faded-bg animated"></div>
        <div class="hidden-xs col-sm-8 col-md-9">
            <div class="clearfix">
                <div class="col-sm-12 col-md-10 col-md-offset-2">
                    <div class="logo-title-container" style="top: 40% !important;">
                        <img class="d-none" src="/images/alteo-admin.png">
                    </div> <!-- .logo-title-container -->
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-3 login-sidebar animated fadeInRightBig">
            <div class="login-container animated fadeInRightBig">

                <h2>{{trans('translate.sign_in')}}:</h2>

                <form action="{{ route('postAdminLogin') }}" method="POST">
                {{ csrf_field() }}
                <div class="group">
                  <input type="text" name="email" value="{{ old('email') }}">
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label><i class="glyphicon glyphicon-user"></i><span class="span-input"> {{trans('translate.email')}}</span></label>
                </div>

                <div class="group">
                  <input type="password" name="password">
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label><i class="glyphicon glyphicon-lock"></i><span class="span-input"> {{trans('translate.password')}}</span></label>
                </div>

                <button type="submit" class="btn btn-block btn-primary">
                    <span class="signin">{{trans('translate.login')}}</span>
                </button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">

                <br>

              </form>
              <a href="{{ route('password.request') }}"> {{trans('translate.reset_password')}}</a>
                @if (config('access.admin_can_register'))
                    <button type="submit" class="btn btn-block btn-secondary">
                        <a href="{{ route('register') }}"> {{trans('translate.register')}}</a>
                    </button>
                @endif

                @include ('admin::admin.includes.message-block')
            </div> <!-- .login-container -->

        </div> <!-- .login-sidebar -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
<script>
    var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    btn.addEventListener('click', function(ev){
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });
</script>
@endsection