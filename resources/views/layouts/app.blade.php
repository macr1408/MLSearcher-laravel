<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mercadolibre Deals Finder') }}</title>

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>
    <script>
        window.navBarLinks = {
            home: "{{ route('home') }}",
            login: "{{ route('login') }}",
            register: "{{ route('register') }}"
        };
        window.userData = {
            mail: "{{ Auth::user()->email ?? '' }}"
        }
    </script>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    @yield('header-scripts')
</head>

<body>
    <div id="app">
        @if(Auth::check())
        <nav-bar-logged-in></nav-bar-logged-in>
        @else
        <nav-bar-guest></nav-bar-guest>
        @endif
        @if(session('notifications'))
        <div class="fixed right-0" style="top:70px;">
            @foreach (session('notifications') as $type => $msg)
            <notification type="{{ $type }}">{{ $msg }}</notification>
            @endforeach
        </div>
        @endif
        <main>
            @yield('content')
        </main>
    </div>
</body>
<style>

</style>
@yield('footer-scripts')

</html>