<h2>Laporan PDF</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Judul Buku</th>
        <th>Nama Anggota</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Denda</th>
    </tr>

    @foreach($data as $item)
    <tr>
        <td>{{ $item->judul_buku }}</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->tanggal_pinjam }}</td>
        <td>{{ $item->tanggal_kembali ?? '-' }}</td>
        <td>{{ $item->denda ?? 0 }}</td>
    </tr>
    @endforeach
</table>
