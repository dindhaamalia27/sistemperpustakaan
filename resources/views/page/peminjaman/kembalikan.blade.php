@extends('layouts.app')

@section('content')

<style>
.container-kembali{
    max-width:600px;
    margin:5px auto;
    transform: translateX(130px);
    font-family: Arial, Helvetica, sans-serif;


    max-height: 80vh; /* 🔥 batas tinggi */
    overflow-y: auto; /* 🔥 scroll cuma di sini */
    padding-right: 10px; /* biar ga ketimpa scrollbar */

}

.card-kembali{
    background:#f1f1f1;
    padding:30px;
    border-radius:10px;
}


.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    font-size:14px;
    margin-bottom:6px;
}

.form-group input{
    width:100%;
    padding:8px;
    border:1px solid #777;
    border-radius:3px;
}

.button-area{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-top:30px;
}

.btn-batal{
    background:#e0e0e0;
    border:none;
    padding:8px 20px;
    border-radius:6px;
    text-decoration:none;
    color:black;
}

.btn-simpan{
    background:#1e88e5;
    color:white;
    border:none;
    padding:8px 20px;
    border-radius:6px;
}

/* 🔥 HILANGIN GARIS + SCROLLBAR */
.container-kembali {
    scrollbar-width: none; /* Firefox */
}

.container-kembali::-webkit-scrollbar {
    width: 0px;
    background: transparent;
}

</style>

<div class="container-kembali">

<h2>Pengembalian Buku</h2>

<div class="card-kembali">

<form action="/peminjaman/{{ $data->id }}/kembalikan" method="POST">
@csrf

<div class="form-group">
<label>Judul buku</label>
<input type="text" name="judul_buku" value="{{ $data->judul_buku }}" readonly>
</div>

<div class="form-group">
<label>Nama peminjam</label>
<input type="text" name="nama" value="{{ $data->nama }}" readonly>
</div>

<div class="form-group">
<label>Tanggal pinjam</label>
<input type="text" name="tanggal_pinjam" value="{{ $data->tanggal_pinjam }}" readonly>
</div>

<div class="form-group">
<label>Jatuh tempo</label>
<input type="text" name="tanggal_jatuh_tempo" value="{{ $data->tanggal_jatuh_tempo }}" readonly>
</div>

<div class="form-group">
<label>Tanggal kembali</label>
<input type="date" name="tanggal_kembali" value="{{ date('Y-m-d') }}">
</div>

<div class="form-group">
<label>Denda</label>
<input type="text" name="denda" value="5000">
</div>

<div class="button-area">
<a href="/peminjaman" class="btn-batal">Batal</a>
<button type="submit" class="btn-simpan">Simpan</button>
</div>

</form>

</div>
</div>

@endsection
