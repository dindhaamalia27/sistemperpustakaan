@extends('layouts.app')

@section('content')

<div style="padding-left:260px; padding-top:40px;">

<h3 style="margin-bottom:30px;">Peminjaman</h3>

<div style="
background:#f2f2f2;
padding:30px;
border-radius:10px;
width:90%;
">

<table style="width:100%; border-collapse:collapse;">

<thead>
<tr style="text-align:left; color:#555;">
<th>Judul Buku</th>
<th>Peminjam</th>
<th>Tanggal pinjam</th>
<th>Jatuh tempo</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($data as $item)

<tr style="border-top:1px solid #ddd; height:60px;">

<td>{{ $item->judul_buku }}</td>

<td>{{ $item->nama }}</td>

<td>{{ $item->tanggal_pinjam }}</td>

<td>{{ $item->tanggal_jatuh_tempo }}</td>

<!-- STATUS -->
<td>
@if($item->status == 'pending')
    <span style="background:#3498db; color:white; padding:5px 12px; border-radius:8px; font-size:12px;">
        pending
    </span>


@elseif($item->status == 'dipinjam')
    <span style="background:orange; color:white; padding:5px 12px; border-radius:8px; font-size:12px;">
        dipinjam
    </span>


@elseif($item->status == 'selesai')
    <span style="background:green; color:white; padding:5px 12px; border-radius:8px; font-size:12px;">
        selesai
    </span>


@elseif($item->status == 'dikembalikan')
    <span style="background:green; color:white; padding:5px 12px; border-radius:8px; font-size:12px;">
        selesai
    </span>


@elseif($item->status == 'ditolak')
    <span style="background:red; color:white; padding:5px 12px; border-radius:8px; font-size:12px;">
        ditolak
    </span>
@endif
</td>


<!-- AKSI (tetap ada) -->
<td>

<a href="{{ ($item->status == 'dikembalikan' || $item->status == 'selesai') ? '#' : '/peminjaman/'.$item->id.'/form-kembali' }}"
style="
background:{{ ($item->status == 'dikembalikan' || $item->status == 'selesai') ? '#999' : '#2d8cf0' }};
color:white;
padding:5px 12px;
border-radius:8px;
font-size:12px;
text-decoration:none;
pointer-events:{{ ($item->status == 'dikembalikan' || $item->status == 'selesai') ? 'none' : 'auto' }};
cursor:{{ ($item->status == 'dikembalikan' || $item->status == 'selesai') ? 'not-allowed' : 'pointer' }};
">

kembalikan

</a>

</td>


</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection
