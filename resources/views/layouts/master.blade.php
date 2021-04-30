<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}" media="none" onload="this.media='all'">
        <link rel="stylesheet" href="{{ mix('/css/main.css')}} ">
        <title>@yield('title', 'Home')</title>
    </head>
    <body class="page-index">
        @include('partials.message')
        <div class="container">
            <header class="mainHeader">
                <div class="wrapper flex">
                    <a href="{{ url('/')}}" class="logo">LaraBlogger</a>
                    <nav>
                        <ul>
                            <li><a href="{{ route('about') }}"{!! request()->routeIs('about') ? ' class="is-active"' : '' !!}">About me</a></li>
                            @auth
                            <li><a href="#logout">Logout</a></li>
                            @else
                            <li><a href="{{ route('login') }}"{!! request()->routeIs('login') ? ' class="is-active"' : '' !!}">Login</a></li>
                            @endauth
                            @can('manage-posts')
                            <li><a href="{{ route('admin.post.create') }}">Create</a></li>
                            @endcan
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="#">RSS <i class="fa fa-rss-square"></i></a></li>
                        </ul>
                    </nav>
                    <form method="GET" action="{{ route('search') }}" class="search">
                        <div class="form-fieldset">
                            <input type="text" name="q" class="form-field" placeholder="Szukaj..." value="{{ request()->get('q') }}">
                        </div>
                    </form>
                </div>
            </header>
            <section class="mainContent">
               @yield('content')
            </section>
            <footer class="mainFooter">
                <div class="wrapper">
                    <p>&copy; {{ date('Y') }} LaraBlogger</p>
                    <nav>
                        <ul>
                            <li><a href="{{ route('about') }}">About me</a></li>
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            @endguest
                            <li><a href="{{ route('admin.post.create') }}">Create</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="#">RSS</a></li>
                        </ul>
                    </nav>
                    <p class="author">All rights reserved <a href="#">LaraBlogger</a></p>
                </div>
            </footer>
        </div>

    @auth
    <form id="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
    </form>

    <script>
        document.querySelector("a[href='#logout']").addEventListener("click", function(e) {
            e.preventDefault();

            document.querySelector("#logout-form").submit();
        }, false);
    </script>
    @endauth

    @yield('footer_scripts')

</body>
</html>
