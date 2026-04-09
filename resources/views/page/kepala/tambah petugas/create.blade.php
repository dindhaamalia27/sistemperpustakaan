@extends('layouts.kepala.app')

@section('content')

<div style="padding-left:260px; padding-top:40px;">

    <h3 style="margin-bottom:30px;">Tambah Petugas</h3>

    <!-- FORM DI TENGAH -->
    <div style="display:flex; justify-content:center;">

        <div style="
            background:#f2f2f2;
            padding:25px;
            border-radius:10px;
            width:350px;
        ">

          <form action="{{ route('kepala.petugas.store') }}" method="POST">
    @csrf
                @if ($errors->any())
                    <div style="margin-bottom:15px; padding:12px; background:#ffe6e6; border:1px solid #e74c3c; border-radius:8px; color:#c0392b;">
                        <strong>Perbaiki dulu ini:</strong>
                        <ul style="margin:10px 0 0 16px; padding:0; list-style:disc;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- NAMA -->
                <div style="margin-bottom:15px;">
                    <label style="font-size:13px;">Nama</label><br>
                    <input type="text" name="name" required
                        style="
                            width:100%;
                            padding:8px;
                            border-radius:6px;
                            border:1px solid #ccc;
                        ">
                </div>

                <!-- EMAIL -->
                <div style="margin-bottom:15px;">
                    <label style="font-size:13px;">Email</label><br>
                    <input type="email" name="email" required
                        style="
                            width:100%;
                            padding:8px;
                            border-radius:6px;
                            border:1px solid #ccc;
                        ">
                </div>

                <!-- PASSWORD -->
                <div style="margin-bottom:20px;">
                    <label style="font-size:13px;">Password</label><br>
                    <input type="password" name="password" required
                        style="
                            width:100%;
                            padding:8px;
                            border-radius:6px;
                            border:1px solid #ccc;
                        ">
                </div>

                <!-- BUTTON -->
                <div style="text-align:right;">
                    <a href="{{ route('kepala.petugas.index') }}" style="
                        background:#95a5a6;
                        color:white;
                        padding:7px 12px;
                        border-radius:6px;
                        text-decoration:none;
                        font-size:13px;
                        margin-right:5px;
                    ">
                        Batal
                    </a>

                    <button type="submit" style="
                        background:#27ae60;
                        color:white;
                        padding:7px 15px;
                        border:none;
                        border-radius:6px;
                        font-size:13px;
                    ">
                        Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
