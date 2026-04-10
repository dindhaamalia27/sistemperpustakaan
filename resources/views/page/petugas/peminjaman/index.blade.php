@extends('layouts.petugas.app')

@section('content')

<style>
    .table td, .table th {
        border: none !important;
        padding: 4px !important;
        font-size: 12px;
        white-space: nowrap;
    }

    /* MATIIN SCROLL */
    .card {
        overflow-x: hidden !important;
    }

    /* BIAR FULL 1 LAYAR */
    table {
        width: 100% !important;
    }

    th, td {
        text-align: center;
    }

    /* BIAR TULISAN KE POTONG, BUKAN TURUN */
    td {
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* KASIH RUANG STATUS & AKSI */
    td:nth-child(5) {
        width: 120px;
    }

    td:nth-child(6) {
        width: 140px;
    }
</style>

<div class="container-fluid" style="padding-left:260px; padding-top:0px;">

    <h4 class="mb-4 fw-semibold">Data Peminjaman</h4>

    <div class="card p-3 shadow-sm border-0"
         style="border-radius:15px; background:#F6F4F4;">

        <table class="table align-middle" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Peminjam</th>
                    <th>Tanggal pinjam</th>
                    <th>Jatuh tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

                    <tbody>
                        @foreach($peminjaman as $item)
                        <tr>
                           <td>{{ $item->judul_buku }}</td>
                           <td>{{ $item->nama }}</td>
                           <td>{{ $item->tanggal_pinjam }}</td>
                           <td>{{ $item->tanggal_jatuh_tempo }}</td>


                            {{-- STATUS --}}
                          <td>

                        @if($item->status == 'pending')
                       <span class="badge rounded-pill bg-primary text-white px-3 py-2">pending</span>

                          @elseif($item->status == 'dipinjam')
                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2">dipinjam</span>

                        @elseif($item->status == 'ditolak')
                      <span class="badge rounded-pill bg-danger px-3 py-2">ditolak</span>

                      @elseif($item->status == 'dikembalikan' || $item->status == 'selesai')
                        <span class="badge rounded-pill bg-success px-3 py-2">selesai</span>
                           @endif
                         </td>

                            {{-- AKSI --}}
                            <td>
                                @if($item->status == 'pending')
                                    <a href="{{ route('petugas.acc', $item->id) }}" class="btn btn-success btn-sm">Acc</a>
                                    <a href="{{ route('petugas.tolak', $item->id) }}" class="btn btn-warning btn-sm">Tolak</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

        </div>
    </div>

@endsection
