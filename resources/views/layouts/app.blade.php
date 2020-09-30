<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="fixed-top navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/dashboard') }}" >
                    <div><img src="{{ URL::to('/') }}/svg/wine.svg" alt="wine icon" width="25" height="25" >
                    {{ config('app.name', 'Laravel') }}</div>
                </a>




                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/dashboard">Dashboard </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/orders">Orders (BAF)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/products">Dry Goods</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/customers">Customers</a>
                        </li>

                    </ul>

                    {{-- search functionality start         --}}
                    <form class="form-inline my-2 my-lg-0" action="/search" method="get" enctype="multipart/form-data">

                        <input name="q" value="{{ old('searchTerm') }}" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                {{-- search functionality end           --}}
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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



        <main class="py-4">

            @yield('content')
        </main>
    </div>
{{--    <footer id="footer" class="site-footer js-footer" role="contentinfo">--}}
{{--        <div class="site-footer--container">--}}


{{--            <div class="site-footer--copyright fs-fine">--}}
{{--                --}}

{{--                <p class="mt-auto mb24">--}}
{{--                    site design / logo &#169; 2020 Stack Exchange Inc; user contributions licensed under <a href="https://stackoverflow.com/help/licensing">cc by-sa</a>.                    <span id="svnrev">rev&nbsp;2020.8.25.37479</span>--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </footer>--}}
    <footer class="fixed-bottom bg-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">© 2020 - Barossa Trading and Bottling Company</div>
            </div>

        </div>
    </footer>
</body>



</html>
