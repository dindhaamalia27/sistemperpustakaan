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
    td:nth-child(7) {
        width: 120px;
    }

    td:nth-child(8) {
        width: 100px;
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

                    <td>
                        @if($item->denda)
                            {{ number_format($item->denda, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>

                      <td>

                {{-- TERLAMBAT --}}
              @if($item->status == 'selesai' && $item->denda > 0)
        <span class="badge bg-danger">Terlambat</span>

            {{-- TEPAT WAKTU --}}
          @elseif($item->status == 'selesai' && $item->denda == 0)
        <span class="badge bg-success">Tepat waktu</span>

    {{-- MENUNGGU --}}
    @elseif($item->tanggal_kembali)
        <span class="badge bg-warning text-dark">Menunggu</span>

    {{-- DEFAULT --}}
    @else
        <span class="badge bg-secondary">Dipinjam</span>

    @endif

</td>


<td>
          {{-- TERIMA --}}
        @if($item->tanggal_kembali)
        <form action="{{ route('petugas.pengembalian.terima', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success btn-sm">Terima</button>
        </form>
        {{-- TOLAK --}}
        <form action="{{ route('petugas.pengembalian.tolak', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-warning btn-sm">Tolak</button>
        </form>
           @endif
      {{-- HAPUS --}}
       <form action="{{ route('petugas.pengembalian.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
           </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection
