@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:30px;">

    <!-- CARD ATAS -->
    <div class="row mb-4 justify-content-center">

        <div class="col-md-3">
            <div class="card text-center p-3 border-0"
                 style="background:#d66b6b; border-radius:10px; color:white;">
                <small>Anggota</small>
                <h5>20</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-3 border-0"
                 style="background:#6fa4c9; border-radius:10px; color:white;">
                <small>Total Buku</small>
                <h5>18</h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center p-3 border-0"
                 style="background:#f4a000; border-radius:10px; color:white;">
                <small>Peminjaman</small>
                <h5>10</h5>
            </div>
        </div>

    </div>

    <!-- TABLE -->
    <div>
        <h6 class="mb-3">Data pengembalian terbaru</h6>

        <!-- BOX -->
        <div style="padding:15px; border-radius:5px; background:white; overflow-x:auto;">

            <table class="table table-borderless text-center" style="font-size:13px; min-width:700px; white-space:nowrap;">
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

                <tbody>
                @foreach($peminjaman as $item)
                <tr>
                    <td>{{ $item->buku->judul ?? '-' }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo }}</td>
                    <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                    <td>{{ $item->denda ?? '-' }}</td>
                    <td>
                        @if($item->status == 'dipinjam')
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
