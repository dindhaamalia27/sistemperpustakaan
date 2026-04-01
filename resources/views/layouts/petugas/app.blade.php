<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Petugas')</title>

    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">
</head>
<body>

<div class="page-wrapper" id="main-wrapper">

    {{-- Sidebar --}}
    @include('layouts.petugas.sidebar')

    <div class="body-wrapper">

        {{-- Header / Navbar --}}
        @include('layouts.petugas.header')

        {{-- Main Content --}}
        <div class="container-fluid p-4">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('layouts.petugas.footer')
    </div>
</div>

<script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>
</html>
