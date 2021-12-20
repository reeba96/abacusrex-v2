<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Abacus Rex</title>
        <link rel="stylesheet" href="/lib/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/animate.min.css">
        <link rel="stylesheet" href="/css/login.css">
        <link rel="stylesheet" href="{{ asset('/css/customAdmin.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="{{ asset('./images/icons/abacus_icon.png') }}" type="image/x-icon">
       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/access.css') }}"> --}}
    </head>
    
    <body>
        
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/access.js') }}"></script> --}}
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

        @include('cookieConsent::index')
    </body>
</html>
