@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">

    <!-- TOMBOL TAMBAH BUKU -->
    <div class="mb-4 text-end">
        <a href="{{ route('petugas.buku.create') }}" class="btn btn-success btn-sm">Tambah Buku</a>
    </div>

    <!-- LIST BUKU -->
    <div class="row">

        <!-- BUKU 1 -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm p-3 border-0"
                 style="border-radius:15px; background:#f1f1f1;">

                <img src="{{ asset('storage/tudung merah.jpg') }}"
                     class="mx-auto mb-2"
                     style="width:90px; height:130px; object-fit:cover;">

                <p class="mb-2">Si Tudung Merah</p>

                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('petugas.buku.detail', 1) }}" class="btn btn-info btn-sm">Detail</a>
                    <!-- TOMBOL EDIT -->
                    <a href="{{ route('petugas.buku.edit', 1) }}" class="btn btn-warning btn-sm">Edit</a
                    <form action="{{ route('petugas.buku.delete', 1) }}" method="POST" class="m-0">
                    @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- BUKU 2 -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm p-3 border-0"
                 style="border-radius:15px; background:#f1f1f1;">

                <img src="{{ asset('storage/angkasa.jpg') }}"
                     class="mx-auto mb-2"
                     style="width:90px; height:130px; object-fit:cover;">

                <p class="mb-2">Angkasa</p>

                <div class="d-flex justify-content-center gap-2">

                    <a href="{{ route('petugas.buku.detail', 2) }}" class="btn btn-info btn-sm">Detail</a>
                    <!-- TOMBOL EDIT -->
                    <a href="{{ route('petugas.buku.edit', 2) }}" class="btn btn-warning btn-sm">Edit</a
                    <form action="{{ route('petugas.buku.delete', 1) }}" method="POST" class="m-0">
                    @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- BUKU 3 -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm p-3 border-0"
                 style="border-radius:15px; background:#f1f1f1;">

                <img src="{{ asset('storage/indonesia.jpg') }}"
                     class="mx-auto mb-2"
                     style="width:90px; height:130px; object-fit:cover;">

                <p class="mb-2">Bahasa Indonesia</p>

                <div class="d-flex justify-content-center gap-2">

                    <a href="{{ route('petugas.buku.detail', 3) }}" class="btn btn-info btn-sm">Detail</a>
                    <!-- TOMBOL EDIT -->
                    <a href="{{ route('petugas.buku.edit', 3) }}" class="btn btn-warning btn-sm">Edit</a
                    <form action="{{ route('petugas.buku.delete', 1) }}" method="POST" class="m-0">
                    @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- BUKU 4 -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm p-3 border-0"
                 style="border-radius:15px; background:#f1f1f1;">

                <img src="{{ asset('storage/adiku yang hilang.jpg') }}"
                     class="mx-auto mb-2"
                     style="width:90px; height:130px; object-fit:cover;">

                <p class="mb-2">Adiku yang Hilang</p>

                <div class="d-flex justify-content-center gap-2">

                    <a href="{{ route('petugas.buku.detail', 4) }}" class="btn btn-info btn-sm">Detail</a>
                    <!-- TOMBOL EDIT -->
                    <a href="{{ route('petugas.buku.edit', 4) }}" class="btn btn-warning btn-sm">Edit</a>
                     <form action="{{ route('petugas.buku.delete', 4) }}" method="POST">
                        <form action="{{ route('petugas.buku.delete', 1) }}" method="POST" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
