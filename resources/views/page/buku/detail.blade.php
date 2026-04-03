@extends('layouts.app')

@section('content')

<style>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
}
</style>

<div class="container" style="margin-top:-8px;">

    <h5 class="mb-2 text-center">Detail Buku</h5>

    <div class="card p-4 shadow mx-auto"
         style="border-radius:20px; background:#f1f3f5; max-width:500px; width:100%;">

       <!-- GAMBAR BUKU -->
        <div class="mb-2 text-center">
            <img src="{{ asset('storage/'.$buku->foto) }}"
                 alt="foto buku"
                 style="width:130px; border-radius:8px;">
        </div>

        <!-- DETAIL BUKU -->
        <p class="mb-1"><strong>Judul buku :</strong> {{ $buku->judul }}</p>
        <p class="mb-1"><strong>Pengarang :</strong> {{ $buku->pengarang }}</p>
        <p class="mb-1"><strong>Penerbit :</strong> {{ $buku->penerbit }}</p>
        <p class="mb-1"><strong>Tahun terbit :</strong> {{ $buku->tahun_terbit }}</p>

        <!-- STOK -->
        <p class="mb-1">
            <strong>Stok :</strong> {{ $buku->stok }}
        </p>

        <p class="mb-1">
            <strong>Status :</strong>
            @if($buku->stok > 0)
                <span class="badge bg-success">Tersedia</span>
            @else
                <span class="badge bg-warning text-dark">Dipinjam</span>
            @endif
        </p>

        <div class="mt-1">
            <strong>Deskripsi</strong>
            <p class="mb-0" style="font-size:13px;">
                {{ $buku->deskripsi }}
            </p>
        </div>

        <!-- TOMBOL -->
        <div class="mt-2 text-center">
            <a href="{{ route('buku.index') }}" class="btn btn-secondary btn-sm">
                ← Kembali
            </a>
        </div>

    </div>
</div>
@endsection
