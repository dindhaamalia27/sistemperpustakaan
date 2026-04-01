<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- CSS Template Themewagon -->
    <link href="{{ asset('assets/css/styles.min.css') }}" rel="stylesheet">
</head>
<body>

<div class="page-wrapper" id="main-wrapper">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    <div class="body-wrapper">

        {{-- Header --}}
        @include('layouts.header')

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>
@include('layouts.footer')
<script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>
