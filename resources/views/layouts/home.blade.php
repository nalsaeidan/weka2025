<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,600" rel="stylesheet" type="text/css"> -->
        
        <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    	<link rel="icon" href="{{asset('uploads/img/icon.png')}}" type="image/png">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/droid-arabic-kufi" type="text/css"/>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- Styles -->
        <style>
            body {
                min-height: 100vh;
                background-color: #ffffff;
                color: #fff;
                background-image: url("uploads/img/header-bg1615127827.jpg");
            }
            .navbar-default {
                background-color: transparent;
                border: none;
            }
            .navbar-static-top {
                margin-bottom: 19px;
            }
            .navbar-default .navbar-nav>li>a {
                color: black;
                font-weight: 600;
                font-size: 15px
            }
            .navbar-default .navbar-nav>li>a:hover{
                color: #d73d71;
            }
            .navbar-default .navbar-brand {
                color: black;
            }
        .navbar-brand:hover{
        color: #d73d71;
        }
        .nav>li>a{
        padding: 10px 10px;
        }
        .nav.navbar-nav.navbar-right.info-items>li>a:hover{
        color: black;
        }
        .navbar-area.absolute {
    position: absolute;
    left: 0;
    top: 58px;
    width: 100%;
    z-index: 2;
    background-color: transparent;
    padding-bottom: 70px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}
        .navbar-area {
    padding: 10px 80px;
    transition: 0.5s ease-in;
}
        * {
    box-sizing: border-box;
    outline: none;
    -webkit-font-smoothing: antialiased;
}
        .navbar-area .navbar-brand {
    margin-right: 0;
}
        .navbar-area .navbar-collapse{
        -webkit-box-pack: end;
        justify-content: flex-end;
        transition: 0.5s ease-in;
    font-family: var(--heading-font);
        }
       
        .navbar-area .navbar-collapse .navbar-nav .nav-item {
    display: inline-block;
    font-size: 16px;
    line-height: 42px;
    font-weight: 400;
    padding: 25px 10px;
    position: relative;
}
        .logo-wrapper.navbar-brand{
        float:right;
        }
        .navbar-brand{
        padding-bottom: .3125rem;
        }
        .navbar-collapse:after{
        padding-bottom: 10px;
        }
        .navbar-area .navbar-collapse .navbar-nav .nav-item .nav-link {
    color: #000000;
    -moz-transition: all 0.3s ease-in;
    -o-transition: all 0.3s ease-in;
    transition: all 0.3s ease-in;
    text-transform: capitalize;
    font-weight: 500;
}
        .navbar-nav>li{
        float: right;
        }
        .title{
            background: -webkit-linear-gradient(#ca347e, #e64f5669);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 600 !important;
        }
        .title.flex-center{
        margin-top: 20%;
        }
        .tagline{
        color: #3333337a;
        }
        @media (min-width: 992px){
.navbar-expand-lg .navbar-toggler {
    display: none;
}
        }
 .content{
 min-height: 140px !important;
        }
        
        </style>
    </head>

    <body>
        @include('layouts.partials.home_header')
        <div class="container">
            <div class="content">
                <!--@yield('content')-->
            </div>
        @include('layouts.home_login_section')
    </div>
        @include('layouts.partials.javascripts')

    <!-- Scripts -->
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
    @yield('javascript')
    </body>
</html>

<!doctype html>

<html lang="{{ config('app.locale') }}">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->