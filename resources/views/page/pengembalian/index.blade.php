@extends('layouts.app')

@section('content')



<div style="padding-left:260px; padding-top:5px;">

<h3 style="margin-bottom:30px;">Data Pengembalian</h3>

<div style="
background:#f2f2f2;
padding:30px;
border-radius:10px;
width:100%;
">

<table style="width:100%; border-collapse:collapse; font-size:14px;">

<thead>
<tr style="text-align:left; color:#555; font-size:12px;">
<th style="padding:10px; white-space:nowrap;">Judul Buku</th>
<th style="padding:10px; white-space:nowrap;">Nama Anggota</th>
<th style="padding:10px; white-space:nowrap;">Tanggal pinjam</th>
<th style="padding:10px; white-space:nowrap;">Jatuh tempo</th>
<th style="padding:10px; padding-left:0; white-space:nowrap;">Tanggal kembali</th>
<th style="padding:10px; white-space:nowrap;">Denda</th>
<th style="padding:10px; white-space:nowrap;">Status</th>
<th style="padding:10px; white-space:nowrap;">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($data as $item)

<tr style="border-top:1px solid #ddd; height:60px;">

<td style="padding:10px; white-space:nowrap; width:180px;">{{ $item->judul_buku }}</td>
<td style="padding:10px; white-space:nowrap; width:150px;">{{ $item->nama }}</td>
<td style="padding:10px; white-space:nowrap; width:140px;">{{ $item->tanggal_pinjam }}</td>
<td style="padding:10px; white-space:nowrap; width:140px;">{{ $item->tanggal_jatuh_tempo }}</td>

<td>
{{ $item->tanggal_kembali ?? '-' }}
</td>

<td style="padding:10px; text-align:center; width:100px;">
    {{ $item->denda !== null ? number_format($item->denda,0,',','.') : '-' }}
</td>

<!-- STATUS -->
<td>
@php
   if($item->status != 'selesai'){
        $status = 'Pending';
    } else {
        $status = 'tepat';
        if($item->tanggal_kembali && $item->tanggal_kembali > $item->tanggal_jatuh_tempo){
            $status = 'Terlambat';
        }
    }
@endphp

@if($status == 'Pending')
    <span style="background:#f39c12; color:white; padding:5px 12px; border-radius:8px; font-size:12px;">
    Pending
</span>

@elseif($status == 'Terlambat')
    <span style="background:#e74c3c; color:white; padding:5px 12px; border-radius:8px; font-size:12px; margin-right:8px;">
    Terlambat
</span>
@else
    <span style="
    background:#27ae60;
    color:white;
    padding:5px 10px;
    border-radius:8px;
    font-size:12px;
    display:inline-block;
">
    tepat
</span>
@endif
</td>

<!-- AKSI -->
<td>
<div style="display:flex; align-items:center; gap:5px;">

@if($status == 'Pending')
    <span style="background:#f39c12; color:white; padding:5px 12px; border-radius:8px; font-size:12px;">
        menunggu
    </span>

@elseif($status == 'Terlambat')
    <span style="background:red; color:white; padding:5px 12px; border-radius:8px; font-size:12px;">
        telat
    </span>

@else
    <span style="
    background:#2d8cf0;
    color:white;
    padding:5px 12px;
    border-radius:8px;
    font-size:12px;
">
    tepat
</span>
@endif

</div>
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection
