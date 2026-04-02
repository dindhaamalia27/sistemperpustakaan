@extends('layouts.petugas.app')

@section('content')

<div class="top-bar"></div>

<div class="container-fluid" style="padding-left:260px; padding-top:0px;">

    <h5 class="mb-4">Edit buku</h5>

    <div class="card p-4 shadow-sm border-0 mx-auto"
         style="border-radius:15px; max-width:600px; background:#F6F4F4;">

        <form action="{{ route('petugas.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- JUDUL -->
            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}">
            </div>

            <!-- PENULIS -->
            <div class="mb-3">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="{{ $buku->pengarang }}">
            </div>


           <!-- Penerbit -->
            <div class="mb-3">
                <label>Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="{{ $buku->penerbit}}">
            </div>
            
            <!-- DESKRIPSI -->
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ $buku->deskripsi }}</textarea>
            </div>

            <!-- TAHUN -->
            <div class="mb-3">
                <label>Tahun Terbit</label>
                <input type="text" name="tahun_terbit" class="form-control" value="{{ $buku->tahun_terbit }}">
            </div>

            <!-- STOK -->
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ $buku->stok }}">
            </div>

            <!-- FOTO -->
            <div class="mb-3">
                <label>Cover Buku</label>

                @if($buku->foto)
                    <div class="mb-2">
                       <img src="{{ asset('storage/' . $buku->foto) }}" width="100">
                    </div>
                @endif

                <input type="file" name="cover" class="form-control">
            </div>

            <!-- BUTTON -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('petugas.buku.index') }}" class="btn btn-light btn-sm me-2">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary btn-sm">
                    simpan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection


<style>
body {
    background: #ffffff !important;
}

h5 {
    font-size: 18px;
    color: #141414;
    margin-top: -10px;
}

.card {
    background: #f1f1f1 !important;
    border-radius: 10px !important;
    margin-top: -30px;
}

label {
    font-size: 12px;
    color: #0e0e0e;
}

.form-control {
    border: 1px solid #121212 !important;
    border-radius: 3px !important;
    font-size: 13px;
    background: #fff !important;
}

.btn-light {
    background: #fff !important;
    border: 1px solid #121212 !important;
    font-size: 12px;
    padding: 6px 10px;
}

.btn-primary {
    background: #1e88e5 !important;
    border: none;
    font-size: 12px;
}

/* FILE INPUT */
.file-wrapper {
    position: relative;
    width: 100%;
}

.real-file {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.fake-input {
    border: 1px solid #121212;
    height: 35px;
    display: flex;
    align-items: center;
    padding-left: 5px;
    background: #fff;
}

.btn-file {
    background: #ddd;
    padding: 5px 10px;
    font-size: 12px;
    border: 1px solid #999;
}

/* ✅ TAMBAHAN (biar warna sama kayak create) */
.card {
    background: #E8E7E7 !important;
}

/* ✅ TAMBAHAN SCROLL */
.card {
    max-height: 80vh;
    overflow-y: auto;
}

/* ✅ TAMBAHAN HILANGKAN GARIS ABU */
.card {
    scrollbar-width: none;
}

.card::-webkit-scrollbar {
    display: none;
}
</style>
