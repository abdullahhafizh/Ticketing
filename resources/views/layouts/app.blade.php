<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="origin-when-crossorigin" id="meta_referrer">
    <meta property="al:android:app_name" content="{{ config('app.name', 'Laravel') }}">
    <meta property="al:ios:app_name" content="{{ config('app.name', 'Laravel') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/images/branding/product/ico/googleg_lodp.ico" rel="shortcut icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        @guest
        <nav class="navbar navbar-default navbar-fixed-bottom">
            @else
            <nav class="navbar navbar-default navbar-static-top">
                @endguest
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img alt="{{ config('app.name', 'Laravel') }}" src="http://getbootstrap.com/favicon.ico" height="25">
                        </a>
                        <!-- Branding Image -->                    
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                            @if(Auth::user()->level==2)                            
                            <li class="{{ Request::segment(1) === 'transportation_type' ? 'active' : null }}"><a href="{{ url('transportation_type') }}">Transportation Type</a></li>
                            <li class="{{ Request::segment(1) === 'transportation' ? 'active' : null }}"><a href="{{ url('transportation') }}">Transportation</a></li>
                            <li class="{{ Request::segment(1) === 'route' ? 'active' : null }}"><a href="{{ url('route') }}">Rute</a></li>                            
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @if(Auth::user()->level==2)
                                    <li class="{{ Request::segment(1) === 'customer' ? 'active' : null }}"><a href="{{ url('customer') }}">Customer</a></li>
                                    <li class="{{ Request::segment(1) === 'users' ? 'active' : null }}"><a href="{{ url('users') }}">Users</a></li>                                    
                                    <li class="{{ Request::segment(1) === 'reservation' ? 'active' : null }}"><a href="{{ url('reservation') }}">Reservation</a></li>
                                    <li class="divider"></li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @guest
        <div style="padding-top: 50px;">
            @yield('content')
        </div>
        @else
        @yield('content')
        @endguest
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>    
</body>
</html>
