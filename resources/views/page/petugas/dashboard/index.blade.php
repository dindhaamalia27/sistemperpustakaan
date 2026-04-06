@extends('layouts.petugas.app')

@section('content')
<style>
/* HILANGKAN SCROLLBAR */
div::-webkit-scrollbar {
    width: 0px;
    background: transparent;
}
</style>


<div class="container-fluid" style="padding-left:260px; padding-top:30px;">

    <!-- CARD ATAS -->
    <div class="row mb-4 justify-content-center">

        <div class="col-md-3">
            <div class="card text-center p-3 border-0"
                 style="background:#d66b6b; border-radius:10px; color:white;">
                <small>Total Petugas</small>
                <h5>{{ $totalpetugas }}</h5>

            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-3 border-0"
                 style="background:#6fa4c9; border-radius:10px; color:white;">
                <small>Total Buku</small>
                <h5>{{ $totalBuku }}</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-3 border-0"
                 style="background:#e18d2e; border-radius:10px; color:white;">
                <small>Peminjaman</small>
                <h5>{{ $totalPinjam }}</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-3 border-0"
                 style="background:#5cb85c; border-radius:10px; color:white;">
                <small>Pengembalian</small>
                <h5>{{ $totalKembali }}</h5>
            </div>
        </div>

    </div>

    <!-- TABLE -->
    <div>
        <h6 class="mb-3">Riwayat peminjaman terbaru</h6>

        <!-- BOX -->
        <div style="padding:15px; border-radius:5px; background:white; overflow-x:auto; max-height:300px; overflow-y:auto;">

            <table class="table table-borderless text-center" style="font-size:13px; min-width:700px; white-space:nowrap;">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal pinjam</th>
                        <th>Jatuh tempo</th>
                        <th>Tanggal kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($peminjaman as $item)
                <tr>
                    <td>{{ $item->judul_buku }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo }}</td>
                    <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                    <td>

    @if($item->status == 'pending')
        <span class="badge bg-warning text-dark">Pending</span>

    @elseif($item->status == 'selesai')
        <span class="badge bg-success">Selesai</span>

    @elseif($item->status == 'dipinjam')
        <span class="badge bg-warning text-dark">Dipinjam</span>

    @elseif($item->status == 'dikembalikan')
        <span class="badge bg-success">Tepat waktu</span>

    @elseif($item->status == 'terlambat')
        <span class="badge bg-danger">Terlambat</span>

    @else
        <span class="badge bg-secondary">{{ $item->status }}</span>
    @endif
</td>

                </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
