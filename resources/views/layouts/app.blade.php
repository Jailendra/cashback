<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ str_replace('-', ' ', config('app.name')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/" type="text/javascript"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="{{ asset('js/google-translate.js') }}" type="text/javascript"></script>
</head>
<body>
    <div id="app">
        <!-- Main Header -->
        <header class="mainHeader">
            <div class="container">
                <div class="mainHeaderInner">
                    <div class="mainLogo">
                        <a href="{{ route('home') }}"><img src="/images/logo.png" class="img-fluid" alt="{{ config('app.name', 'Laravel') }}" /> </a>
                    </div>
                    <div class="searchBox">
                        <form action="{{route('home')}}" class="searchForm" method="get">
                            <input placeholder="Search by Keywords" class="form-control" name="search">
                            <button class="searchButton"><img src="/images/Search.png" alt=""></button>
                        </form>
                    </div>
                    <div class="signinJoin">
                        <ul>
                        <!-- Authentication Links -->
                        @guest
                            <li>
                                <a href="{{ route('login') }}">
                                    <img src="/images/Sign-In.png" alt="Login" /> {{ __('Sign in') }}
                                </a>
                            </li>
                            @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}">{{ __('Join for Free') }}</a>
                            </li>
                            @endif
                        @else
                        <li>
                            <div class="dropdown"> <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @if(Auth::user()->role=="admin")
                                <li class="dropdown-item"><a href="{{ route('admin.home') }}"><i class="fa fa-user mr-2"></i> Back Office</a></li>
                                <li class="dropdown-divider"></li>
                                @endif

                                <li class="dropdown-item"><a href="{{ route('user.profile') }}"><i class="fa fa-user mr-2"></i> My Profile</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="{{ route('subscriptions') }}"><i class="fa fa-user mr-2"></i>Subscriptions</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="{{ route('user-subscriptions') }}"><i class="fa fa-user mr-2"></i>My Subscription</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="{{ route('sum-cashback') }}"><i class="fa fa-cog mr-2"></i> Cashback Overview</a></li>

                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="{{ route('bank.details') }}"><i class="fa fa-cog mr-2"></i> Bank Details </a></li>

                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                </li>
                            </ul>
                            </div>
                        </li>
                        @endguest
                        </ul>
                        <ul>
                    </div>

                    
                    <!-- Google Translate Element begin -->
                    <div id="google_translate_element"></div>
                    <!-- Google Translate Element end -->
                    
                </div>
            </div>
        </header>
        <!-- End Main Header -->

        <!-- Main Menu -->
        @include('layouts.top-navigation')
        <!-- End Main Menu -->

        <main>
            @yield('content')
        </main>
    </div>
    @extends('layouts.footer')
</body>
</html>