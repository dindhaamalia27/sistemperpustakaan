@extends('layouts.petugas.app')

@section('content')

<style>
    .table td, .table th {
        border: none !important;
        padding: 6px 4px !important;
        font-size: 12px;
        white-space: nowrap;
    }

    table {
        width: 100% !important;
    }

    th, td {
        text-align: center;
    }

    td {
        overflow: hidden;
        text-overflow: ellipsis;
    }

    td:nth-child(7) {
        width: 110px;
    }

    td:nth-child(8) {
        width: 110px;
    }

    td:nth-child(9) {
        width: 250px;
        text-align: left;
        overflow: visible !important;
    }

    .card {
        overflow-x: auto;
    }
</style>

<div class="top-bar"></div>

<div class="container-fluid" style="padding-left:260px; padding-top:0px;">

    <h4 class="mb-4">Data Pengembalian</h4>

    <div class="card p-3 shadow-sm border-0"
         style="border-radius:15px; background:#F6F4F4;">

        <table class="table align-middle" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal pinjam</th>
                    <th>Jatuh tempo</th>
                    <th>Tanggal kembali</th>
                    <th>Kondisi</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->judul_buku }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_jatuh_tempo }}</td>
                    <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                    <td>{{ $item->kondisi ?? '-' }}</td>
                    <td>
                        @if($item->denda !== null)
                            {{ number_format($item->denda, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if($item->status == 'selesai' && $item->denda > 0)
                            <span class="badge bg-success">Selesai</span>
                        @elseif($item->status == 'selesai' && $item->denda == 0)
                            <span class="badge bg-success">Selesai</span>
                        @elseif($item->status == 'dikembalikan')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @else
                            <span class="badge bg-secondary">Dipinjam</span>
                        @endif
                    </td>

                    <td>
                        @if($item->status == 'dikembalikan')
                            <form action="{{ route('petugas.pengembalian.terima', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Terima</button>
                            </form>

                            <form action="{{ route('petugas.pengembalian.tolak', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-warning btn-sm">Tolak</button>
                            </form>

                            <form action="{{ route('petugas.pengembalian.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')" style="display:inline; margin-left:4px;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif

                        @if($item->status == 'selesai' && $item->denda > 0)
                            <a href="{{ route('petugas.pengembalian.cetak', $item->id) }}" class="btn btn-primary btn-sm" style="display:inline; margin-left:4px;">Cetak</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

    {{-- ===================== LAPORAN DENDA (TAMBAHAN) ===================== --}}
    <br><br>

    <h4>Laporan Denda</h4>

    <div class="card p-3 shadow-sm border-0"
         style="border-radius:15px; background:#F6F4F4; margin-top:10px;">

        <table class="table align-middle" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Kembali</th>
                    <th>Kondisi</th> <!-- TAMBAHAN -->
                    <th>Denda</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @php $totalDenda = 0; @endphp

                @foreach($data as $item)
                    @if($item->denda !== null && $item->denda > 0)

                    @php $totalDenda += $item->denda; @endphp

                    <tr>
                        <td>{{ $item->judul_buku }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->tanggal_kembali }}</td>

                        <td>{{ $item->kondisi ?? '-' }}</td> <!-- TAMBAHAN KONDISI -->

                        <td>{{ number_format($item->denda, 0, ',', '.') }}</td>
                        <td><span class="badge bg-danger">Ada Denda</span></td>
                    </tr>

                    @endif
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:10px; font-weight:bold;">
            Total Denda: Rp {{ number_format($totalDenda, 0, ',', '.') }}
        </div>

    </div>

</div>

@endsection
