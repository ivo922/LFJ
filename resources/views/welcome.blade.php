<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Looking For Job - Job searching made easy!</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                font-family: 'Montserrat', sans-serif;
                font-weight: 200;
                height: 100vh;
                width:100%;
                margin: 0;
            }

            .header-image-area {
                background-image: url(images/front-page-slide-2.jpg);
                height: 100vh;
                width: 100%;
                background-position: 50% 0;
                background-size: cover;
                position: relative;
                -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 100% 100%, 0 85%);
                clip-path: polygon(0 0, 100% 0, 100% 100%, 100% 100%, 0 85%);
            }
            .header-image-area:before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100vh;
                background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(53, 152, 70, 0.9)), color-stop(rgba(40, 85, 51, 0.8)), to(rgba(21, 51, 29, 0.8)));
                background-image: -webkit-linear-gradient(top, rgba(53, 152, 70, 0.9), rgba(40, 85, 51, 0.8), rgba(21, 51, 29, 0.8));
                background-image: -o-linear-gradient(top, rgba(53, 152, 70, 0.9), rgba(40, 85, 51, 0.8), rgba(21, 51, 29, 0.8));
                background-image: linear-gradient(to bottom, rgba(53, 152, 70, 0.9), rgba(40, 85, 51, 0.8), rgba(21, 51, 29, 0.8))
            }

            .intro-text {
                position: absolute;
                left: 0%;
                top: 37%;
                margin: auto;
                right: 0;
                text-align: center
            }
            .intro-text h1 {
                text-transform: uppercase;
                font-size: 42px;
                letter-spacing: 1px;
                color: white;
                margin-bottom: 10px;
                font-weight: 900;
                letter-spacing: 1px
            }
            .intro-text h3 {
                font-size: 18px;
                letter-spacing: 1px;
                color: #e5e5e5;
                font-weight: 400;
                line-height: 28px
            }

            .card {
                border-radius: 0;
                -moz-box-shadow: 0 0 5px #999;
                -webkit-box-shadow: 0 0 5px #999;
                box-shadow: 0 0 5px #999;
            }

            .search-img {
                margin:20px auto;
            }

            .footer-black {
                width: 100%;
                float: left;
                bottom:0;
                margin-top:30px;
                background-color:#212529;
                color:white;
                font-weight:900;
            }

            a {
            color:rgb(50, 150, 50);
            }

            a:hover {
                text-decoration:none;
                color:rgb(80, 200, 80);
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!--{{ config('app.name', 'Laravel') }}-->
                    <img src="\images\lfj-logo-new.png" alt="image"/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="header-image-area">
            <div class="intro-text">
                <h1>Looking For Job</h1>
                <h3>Job searching made easy!</h3>
                @if(Auth::check())
                <a href="{{ url('my-profile') }}"><button class="btn btn-sm btn-warning">My Profile</button></a>
                <a href="{{ url('users') }}"><button class="btn btn-sm btn-warning">Admin Panel</button></a>
                @else
                <a href="{{ url('login') }}"><button class="btn btn-sm btn-warning">Sign In</button></a>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="card col-md-4 text-center py-3">
                    <img src="<?php echo asset('images/search-final.png')?>" class="search-img" height="150px" width="150px" />
                    <p>Browse hundreds of job offers<br /> from various companies!<br /><br />See all open offers here:</p>
                    <a href="{{ url('jobs') }}"><button class="btn btn-sm btn-warning">Find a job!</button></a>
                </div>
                <div class="col-md-2"></div>
                <div class="card col-md-4 text-center py-3">
                    <img src="<?php echo asset('images/companies.png')?>" class="search-img" height="150px" width="150px" />
                    <p>See the employers behind our job offers!<br /><br />Over 50 companies trusted LookingForJob<br />and the number is increasing rapidly!<br /></p>
                    <a href="{{ url('companies') }}"><button class="btn btn-sm btn-warning">Click!</button></a>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <!-- Footer -->
        <div class="footer-copyright text-center py-3 col-md-12 footer-black">© 2020 Copyright:
            <a href="/"> LookingForJob.com</a>
        </div>
    </body>
</html>
