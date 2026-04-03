@extends('layouts.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">
    <div class="card shadow-sm p-4" style="background:#f5f5f5; color:#333;">
        <h6>Riwayat peminjam baru</h6>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Judul buku</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh tempo</th>
                    <th>Status</th>
                </tr>
            </thead>

            <!-- ✅ INI YANG SUDAH DIPERBAIKI -->
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->judul_buku }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_pinjam)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_jatuh_tempo)) }}</td>
                    <td>
                        @if($item->status == 'dipinjam')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @elseif($item->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-secondary">{{ $item->status }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <!-- ✅ SAMPAI SINI -->

        </table>
    </div>
</div>
@endsection
