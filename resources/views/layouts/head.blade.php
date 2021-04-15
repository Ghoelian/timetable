<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>

    <meta charset="utf-8" />
    <meta name="description" content="Time tracking" />
    <meta name="author" content="Julian Vos" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-title" content="Julian Vos Timetable" />
    <meta name="application-name" content="Julian Vos Timetable" />
    <meta name="msapplication-TileColor" content="#2b5797" />
    <meta name="msapplication-TileImage" content="/icons/mstile-144x144.webp" />
    <meta name="msapplication-config" content="/icons/browserconfig.xml" />
    <meta name="theme-color" content="#2b5797" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/faf5088e45.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/alert.js') }}"></script>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="194x194" href="{{ asset('icons/favicon-194x194.png') }}" />
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icons/android-chrome-192x192.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />
    <link rel="mask-icon" href="{{ asset('icons/safari-pinned-tab.svg') }}" color="#2b5797" />
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="css/material.css">

    @stack('assets')

    @if ($errors->any())
        <script>
            $('document').ready(() => {
                showError('{{ $errors->first() }}')
            })
        </script>
    @endif
</head>

<body>
    @include('layouts.nav')

    <div class="container p-1">
        @yield('content')

        <span class="fixed-bottom" id="warning"></span>
        <span class="fixed-bottom" id="success"></span>
    </div>
    &nbsp;

    @include('layouts.footer')
</body>

</html>
