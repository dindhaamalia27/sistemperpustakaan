@extends('layouts.app')

@section('content')

<style>
.container-pinjam{
    width:500px;
    margin:10px auto;
    transform: translateX(130px);
    font-family: Arial, Helvetica, sans-serif;
}

.card-pinjam{
    background:#eceaea;
    padding:25px;
    border-radius:8px;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    font-size:13px;
    margin-bottom:4px;
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
    margin-top:15px;
}

.btn-batal{
    background:#e0e0e0;
    border:none;
    padding:6px 16px;
    border-radius:6px;
    cursor:pointer;
}

.btn-simpan{
    background:#1e88e5;
    color:white;
    border:none;
    padding:6px 16px;
    border-radius:6px;
    cursor:pointer;
}
</style>

<div class="container-pinjam">

<h4>Pinjam Buku</h4>

<div class="card-pinjam">

<form action="/pinjam/simpan" method="POST">
@csrf

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama" value="{{ auth()->user()->name }}">
</div>

<div class="form-group">
<label>Judul Buku</label>
<input type="text" name="judul_buku" value="{{ $buku->judul }}">
</div>

<div class="form-group">
<label>Tanggal pinjam</label>
<input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}">
</div>

<div class="form-group">
<label>Tanggal jatuh tempo</label>
<input type="date" name="tanggal_jatuh_tempo" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
</div>

<div class="button-area">
<a href="{{ route('buku.index') }}" class="btn-batal">Batal</a>
<button type="submit" class="btn-simpan">Simpan</button>
</div>

</form>

</div>
</div>

@endsection
