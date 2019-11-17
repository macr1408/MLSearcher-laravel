<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mercadolibre Deals Finder') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        window.navBarLinks = {
            home:  "{{ route('home') }}",
            login:  "{{ route('login') }}",
            register:  "{{ route('register') }}"
        };
    </script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('header-scripts')
</head>

<body>
    <div id="app">
        <nav-bar></nav-bar>
        <main>
            @yield('content')
        </main>
    </div>
</body>
<style>

</style>
@yield('footer-scripts')

</html>