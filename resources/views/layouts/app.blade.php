<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Spatie Permission') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')

</head>
<body>
    <div id="app">

        {{-- navbar --}}
        @include('layouts.navbar')

        {{-- main content --}}
        <main class="py-4">
            @yield('content')
        </main>

        {{-- alert --}}
        @include('layouts.alert')

        {{-- scripts --}}
        <script src="{{ asset('vendor/jquery/jquery-3.5.1.js') }}"></script>
        @stack('scripts')
    </div>

</body>
</html>
