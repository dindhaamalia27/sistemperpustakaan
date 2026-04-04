@extends('layouts.kepala.app')

@section('content')

@php
    $totalBuku = \App\Models\Petugas\Buku::count();
    $totalAnggota = \App\Models\User::where('role', 'anggota')->count();
    $totalPeminjaman = \App\Models\Peminjaman::count();
    $totalPengembalian = \App\Models\Peminjaman::whereNotNull('tanggal_kembali')->count();
@endphp

<div style="padding-left:260px; padding-top:30px;">

    <h3 style="margin-bottom:25px;">Dashboard Kepala</h3>

    <!-- CARD WRAPPER -->
    <div style="
        display:flex;
        gap:20px;
        flex-wrap:wrap;
        justify-content:center;
        max-width:700px;
        margin:auto;
    ">

        <!-- CARD 1 -->
        <div style="
            flex:0 0 45%;
            min-width:250px;
            background:#64ABD8;
            color:white;
            padding:25px;
            border-radius:12px;
            text-align:center;
        ">
            <h5>Total Buku</h5>
            <h2>{{ $totalBuku }}</h2>
        </div>

        <!-- CARD 2 -->
        <div style="
            flex:0 0 45%;
            min-width:250px;
            background:#CE6C6E;
            color:white;
            padding:25px;
            border-radius:12px;
            text-align:center;
        ">
            <h5>Total Anggota</h5>
            <h2>{{ $totalAnggota }}</h2>
        </div>

        <!-- CARD 3 -->
        <div style="
            flex:0 0 45%;
            min-width:250px;
            background:#FF9800;
            color:white;
            padding:25px;
            border-radius:12px;
            text-align:center;
        ">
            <h5>total Peminjaman</h5>
            <h2>{{ $totalPeminjaman }}</h2>
        </div>

        <!-- CARD 4 -->
        <div style="
            flex:0 0 45%;
            min-width:250px;
            background:#CF1B1B;
            color:white;
            padding:25px;
            border-radius:12px;
            text-align:center;
        ">
            <h5> total Pengembalian</h5>
            <h2>{{ $totalPengembalian }}</h2>
        </div>

    </div>

</div>

@endsection
