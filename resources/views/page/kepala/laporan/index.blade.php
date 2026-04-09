@extends('layouts.kepala.app')

@section('content')

<style>
.container-data{
    max-width:1000px;
    margin:40px auto;
    font-family: Arial, Helvetica, sans-serif;
    margin-left:300px;
}

/* 🔥 FIX SCROLL + GA KETUMPUK + HILANGKAN SCROLLBAR */
.card-data{
    background:#ffffff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);

    position:fixed;
    top:200px !important;   /* biar ga nutup filter */
    left:320px;
    right:40px;
    bottom:30px;

    overflow-y:auto;

    scrollbar-width: none;       /* Firefox */
    -ms-overflow-style: none;    /* IE */
}

/* Chrome, Edge, Safari */
.card-data::-webkit-scrollbar{
    display: none;
}

/* TABLE */
.table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

.table thead{
    background:#f7f7f7;
}

.table th{
    padding:12px 8px;
    font-size:12px;
    color:#555;
    text-transform:uppercase;
}

.table td{
    padding:10px 8px;
    border-top:1px solid #eee;
}

.table tbody tr:hover{
    background:#fafafa;
}

/* BADGE */
.badge{
    padding:5px 12px;
    border-radius:20px;
    font-size:11px;
    color:white;
    display:inline-block;
}

.hijau{ background:#2ecc71; }
.merah{ background:#e74c3c; }
.oren{ background:#f39c12; }
.biru{ background:#3498db; }

.jarak{
    margin-top:40px;
}
</style>

<div class="container-data">

 <div style="display:flex; gap:10px; margin-bottom:20px; font-size:16px; font-weight:bold;">
    <div>Daftar Peminjaman</div>
    <div>Dan</div>
    <div>Daftar Pengembalian</div>
 </div>

 <!-- FILTER -->
 <div style="margin-bottom:15px;">
    <label style="font-size:13px;">Pilih Tanggal:</label>
    <input type="date" id="filterTanggal" style="padding:6px; border-radius:6px; border:1px solid #ccc;">
    <span id="hariInfo" style="margin-left:15px; font-size:13px; color:#555;"></span>
 </div>

 <div class="card-data">

    <!-- PEMINJAMAN -->
    <table class="table">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Nama Anggota</th>
                <th>Tanggal pinjam</th>
                <th>Jatuh tempo</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="peminjamanTable">
            @foreach($data as $item)
            @php
                if(strtolower(trim($item->status)) == 'pending'){
                    $status = 'Pending';
                    $class = 'biru';
                } elseif(in_array(strtolower(trim($item->status)), ['dikembalikan','selesai'])){
                    $status = 'Selesai';
                    $class = 'hijau';
                } elseif(strtolower(trim($item->status)) == 'dipinjam'){
                    $status = 'Dipinjam';
                    $class = 'oren';
                } else {
                    $status = 'Pending';
                    $class = 'biru';
                }
            @endphp

            <tr data-tanggal="{{ date('Y-m-d', strtotime($item->tanggal_pinjam)) }}">
                <td>{{ $item->judul_buku }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->tanggal_jatuh_tempo }}</td>
                <td><span class="badge {{ $class }}">{{ $status }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- PENGEMBALIAN -->
    <table class="table jarak">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Nama Anggota</th>
                <th>Tanggal pinjam</th>
                <th>Jatuh tempo</th>
                <th>Tanggal kembali</th>
                <th>Denda</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="pengembalianTable">
            @foreach($data as $item)

            @if(!empty($item->tanggal_kembali))

            @php
                if(strtotime($item->tanggal_kembali) > strtotime($item->tanggal_jatuh_tempo)){
                    $status = 'Terlambat';
                    $class = 'merah';
                } else {
                    $status = 'Tepat waktu';
                    $class = 'hijau';
                }
            @endphp

            <tr data-tanggal="{{ date('Y-m-d', strtotime($item->tanggal_pinjam)) }}">
                <td>{{ $item->judul_buku }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->tanggal_jatuh_tempo }}</td>
                <td>{{ $item->tanggal_kembali }}</td>
                <td>{{ $item->denda ?? '-' }}</td>
                <td><span class="badge {{ $class }}">{{ $status }}</span></td>
            </tr>

            @endif
            @endforeach
        </tbody>
    </table>

 </div>
</div>

<script>
function formatTanggal(tgl){
    if(!tgl) return '';
    if(tgl.includes('-')) return tgl;

    let parts = tgl.split('/');
    return parts[2] + '-' + parts[1] + '-' + parts[0];
}

function filterTanggal(){
    let selected = document.getElementById('filterTanggal').value;

    let rowsPinjam = document.querySelectorAll('#peminjamanTable tr');
    let rowsKembali = document.querySelectorAll('#pengembalianTable tr');

    let hariText = '';
    if(selected){
        let hari = new Date(selected).toLocaleDateString('id-ID', { weekday: 'long' });
        hariText = 'Hari: ' + hari;
    }
    document.getElementById('hariInfo').innerText = hariText;

    rowsPinjam.forEach(row => {
        let tanggal = formatTanggal(row.getAttribute('data-tanggal'));
        row.style.display = (!selected || tanggal === selected) ? '' : 'none';
    });

    rowsKembali.forEach(row => {
        let tanggal = formatTanggal(row.getAttribute('data-tanggal'));
        row.style.display = (!selected || tanggal === selected) ? '' : 'none';
    });
}

document.getElementById('filterTanggal').addEventListener('change', filterTanggal);

window.onload = function(){
    filterTanggal();
}
</script>

@endsection
