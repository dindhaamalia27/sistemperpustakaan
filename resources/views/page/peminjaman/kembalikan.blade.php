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
<input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
</div>

<div class="form-group">
<label>Kondisi buku</label>
<select name="kondisi" id="kondisi" required>
    <option value="">Pilih kondisi</option>
    <option value="baik">Baik</option>
    <option value="rusak">Rusak</option>
    <option value="hilang">Hilang</option>
</select>
</div>

<div class="form-group">
<label>Denda</label>
<input type="text" id="denda_text" value="Rp 0" readonly>
<input type="hidden" name="denda" id="denda" value="0">
</div>

<div class="button-area">
<a href="/peminjaman" class="btn-batal">Batal</a>
<button type="submit" class="btn-simpan">Ajukan</button>
</div>

</form>

</div>
</div>

<script>
    const tanggalKembaliInput = document.getElementById('tanggal_kembali');
    const kondisiInput = document.getElementById('kondisi');
    const dendaInput = document.getElementById('denda');
    const dendaText = document.getElementById('denda_text');
    const tanggalJatuhTempo = '{{ $data->tanggal_jatuh_tempo }}';

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(value);
    }

    function hitungDenda() {
        const kondisi = kondisiInput.value;
        const tanggalKembali = tanggalKembaliInput.value;

        if (!kondisi || !tanggalKembali) {
            dendaInput.value = 0;
            dendaText.value = formatRupiah(0);
            return;
        }

        let denda = 0;
        if (kondisi === 'baik') {
            const kembali = new Date(tanggalKembali);
            const tempo = new Date(tanggalJatuhTempo);
            const hariTelat = Math.max(0, Math.floor((kembali - tempo) / (1000 * 60 * 60 * 24)));
            denda = hariTelat * 5000;
        } else if (kondisi === 'rusak') {
            denda = 30000;
        } else if (kondisi === 'hilang') {
            denda = 100000;
        }

        dendaInput.value = denda;
        dendaText.value = formatRupiah(denda);
    }

    tanggalKembaliInput.addEventListener('change', hitungDenda);
    kondisiInput.addEventListener('change', hitungDenda);
</script>

@endsection
