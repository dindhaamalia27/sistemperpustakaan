<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
</head>
<body onload="window.print()">

    <h2 style="text-align:center;">Laporan Peminjaman Buku</h2>

    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
        </tr>

        @foreach($data as $i => $item)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->buku->judul }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </table>
<h2 style="margin-top:30px;">Data Pengembalian</h2>

<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Jatuh Tempo</th>
        <th>Tanggal Kembali</th>
        <th>Denda</th>
        <th>Status</th>
    </tr>

    @php $no = 1; @endphp
    @foreach($data as $item)

    @if(!empty($item->tanggal_kembali))

    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->judul_buku }}</td>
        <td>{{ $item->tanggal_pinjam }}</td>
        <td>{{ $item->tanggal_jatuh_tempo }}</td>
        <td>{{ $item->tanggal_kembali }}</td>
        <td>{{ $item->denda ?? '-' }}</td>
        <td>
            @if(strtotime($item->tanggal_kembali) > strtotime($item->tanggal_jatuh_tempo))
                Terlambat
            @else
                Tepat Waktu
            @endif
        </td>
    </tr>

    @endif
    @endforeach
</table>






</body>
</html>
