@extends('layouts.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top: 100px; width:100%;">
    <div style="max-width:720px; margin:0 auto; width:100%; padding: 0 20px;">
        <h5 class="mb-4 text-center" style="font-size: 26px; letter-spacing: 0.02em;">Detail Buku</h5>

        <div class="card p-4 shadow mx-auto"
             style="border-radius:24px; background:#ffffff; width:100%; box-shadow:0 25px 70px rgba(0,0,0,0.08);">

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

        <div class="mt-3">
            <strong>Sinopsis</strong>
            <div style="max-height: 260px; overflow-y: auto; font-size:13px; padding: 16px; border: 1px solid #e5e7eb; border-radius: 14px; background: #fafafa; line-height: 1.7; white-space: pre-wrap;">
                {{ $buku->deskripsi }}
            </div>
        </div>

        <!-- TOMBOL -->
        <div class="mt-4 text-center">
            <a href="{{ route('buku.index') }}" class="btn btn-secondary btn-sm">
                ← Kembali
            </a>
        </div>

    </div>
</div>
@endsection
