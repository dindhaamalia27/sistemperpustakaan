<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- CSS Template Themewagon -->
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">
    <style>
        /* Styling untuk layout halaman */
        html, body {
            overflow-x: hidden !important;
            overflow-y: auto !important;
            min-height: 100% !important;
            height: auto !important;
        }
        .page-wrapper,
        .body-wrapper {
            overflow: visible !important;
            min-height: 100vh !important;
        }
        .body-wrapper {
            padding-top: 60px !important;
        }
    </style>
</head>
<body>

<div class="page-wrapper" id="main-wrapper">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <div class="body-wrapper">

        {{-- Header --}}
        @include('layouts.header')

        {{-- Konten utama --}}
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>
@include('layouts.footer')
<script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>
