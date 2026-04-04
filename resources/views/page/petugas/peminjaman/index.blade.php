@extends('layouts.petugas.app')

@section('content')

<style>
    .container {
        max-width: 900px;
         margin-left: 260px; /* ⬅️ tambahin di sini */
    }

    table {
        font-size: 13px;
    }

    th, td {
        padding: 6px 8px;
    }
</style>

<div class="container mt-4">

    <h4 class="mb-4 fw-semibold">Data Peminjaman</h4>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="text-muted" style="font-size: 14px;">
                        <tr>
                            <th>Judul Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal pinjam</th>
                            <th>Jatuh tempo</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody style="font-size: 14px;">
                        @foreach($peminjaman as $item)
                        <tr>
                           <td>{{ $item->judul_buku }}</td>
                           <td>{{ $item->nama }}</td>
                           <td>{{ $item->tanggal_pinjam }}</td>
                           <td>{{ $item->tanggal_jatuh_tempo }}</td>


                            {{-- STATUS --}}
                          <td>

                         @if($item->status == 'pending')
                         <span class="badge rounded-pill bg-warning text-dark px-3 py-2">pending</span>

                          @elseif($item->status == 'dipinjam')
                        <span class="badge rounded-pill bg-warning text-dark px-3 py-2">dipinjam</span>

                        @elseif($item->status == 'ditolak')
                      <span class="badge rounded-pill bg-danger px-3 py-2">ditolak</span>

                      @elseif($item->status == 'dikembalikan' || $item->status == 'selesai')
                        <span class="badge rounded-pill bg-success px-3 py-2">selesai</span>
                           @endif
                         </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                        @if($item->status == 'pending')
                           <a href="{{ route('petugas.acc', $item->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">Acc</a>
                          <a href="{{ route('petugas.tolak', $item->id) }}" class="btn btn-danger btn-sm rounded-pill px-3">tolak</a>


                          @else

                       @endif
                         </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
