@extends('access::layouts.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('/theme/alteo/css/front.css') }}"></link>

        <style>
            body{
            /* Safari 4-5, Chrome 1-9 */
              background: -webkit-gradient(radial, center center, 0, center center, 460, from(#1a82f7), to(#2F2727));

            /* Safari 5.1+, Chrome 10+ */
              background: -webkit-radial-gradient(circle, #1a82f7, #2F2727);

            /* Firefox 3.6+ */
              background: -moz-radial-gradient(circle, #1a82f7, #2F2727);

            /* IE 10 */
              background: -ms-radial-gradient(circle, #1a82f7, #2F2727);
              height:600px;
            }

            .centered-form{
                    margin-top: 60px;
            }

            .centered-form .panel{
                    background: rgba(255, 255, 255, 0.8);
                    box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
            }

            label.label-floatlabel {
                font-weight: bold;
                color: #46b8da;
                font-size: 11px;
            }
        </style>
    @include ('access::includes.message-block')
    <div class="container">
            <div class="row centered-form register-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="card">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center">ICBTech CMS</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ route('postRegister') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input value='{{old("username")}}' type="text" name="username" id="username" class="form-control input-sm" placeholder="{{trans('translate.username')}}">
                            </div>

                            <div class="form-group">
                                <input value='{{old("email")}}' type="email" name="email" id="email" class="form-control input-sm" placeholder="{{trans('translate.email_address')}}">
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control input-sm" placeholder="{{trans('translate.password')}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="{{trans('translate.confirm_pass')}}">
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="{{trans('translate.register')}}" class="btn btn-info btn-block">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>

@endsection