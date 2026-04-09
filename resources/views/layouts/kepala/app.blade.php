<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Kepala')</title>

    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">
    <style>
        html, body {
            overflow-x: hidden !important;
            overflow-y: auto !important;
            min-height: 100% !important;
            height: auto !important;
            margin: 0;
        }
        .page-wrapper,
        .body-wrapper {
            overflow: visible !important;
            min-height: 100vh !important;
        }
        .body-wrapper {
            padding-top: 60px !important;
        }
        .app-header {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            z-index: 1000;
            min-height: 60px;
            background: #83c2e1;
        }
        .app-header .navbar {
            margin: 0;
            min-height: 60px;
            width: 100%;
            padding: 0 20px;
        }
    </style>
</head>
<body>

<div class="page-wrapper" id="main-wrapper">

    {{-- Sidebar --}}
    @include('layouts.kepala.sidebar')

    <div class="body-wrapper">

        {{-- Header / Navbar --}}
        @include('layouts.kepala.header')

        {{-- Main Content --}}
        <div class="container-fluid p-4">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('layouts.kepala.footer')
    </div>
</div>

<script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>
</html>
