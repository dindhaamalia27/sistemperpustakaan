@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">

        
            <div class="card p-3 shadow-sm border-0 mx-auto" style="border-radius:15px; max-width:450px; background:#f1f1f1;">

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
        <p><b>Deskripsi:</b> {{ $buku->deskripsi }}</p>

        <div class="text-center mt-3">
            <a href="{{ route('petugas.buku.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>

    </div>

</div>

@endsection
