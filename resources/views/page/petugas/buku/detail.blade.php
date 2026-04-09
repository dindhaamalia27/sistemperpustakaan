@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top: 100px; width:100%;">
    <div style="max-width:720px; margin:0 auto; width:100%; padding: 0 20px;">

        <div class="card p-4 border-0 mx-auto" style="border-radius:24px; background:#ffffff; width:100%; box-shadow: 0 25px 70px rgba(0,0,0,0.08);">


        <!-- GAMBAR BUKU -->
        <div class=" text-center">
            <img src="{{ asset('storage/'.$buku->foto) }}"
                 alt="foto buku"
                 style="width:100px; border-radius:4px;">
        </div>



        <h4 class="mt-3 text-center">{{ $buku->judul }}</h4>

        <p><b>Pengarang:</b> {{ $buku->pengarang }}</p>
        <p><b>Penerbit:</b> {{ $buku->penerbit }}</p>
        <p><b>Tahun:</b> {{ $buku->tahun_terbit }}</p>


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

        <div class="text-center mt-4">
            <a href="{{ route('petugas.buku.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>

    </div>

</div>

@endsection
