<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <!-- Title -->
    <title>Laravel 10 - Tasks list</title>
    @yield('styles')

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <div id="app">
        {{-- @include('partials.navbar') --}}

        <h1>@yield('title')</h1>
        @if (session()->has('success'))
            <div>{{ session('success') }}</div>
        @endif
        <div>
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>
