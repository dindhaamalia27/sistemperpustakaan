@extends('layouts.app')

@section('content')
<style>
/* ✅ SCROLL KE BAWAH */
.table-container {
    max-height: 300px;
    overflow-y: auto;
    background: transparent !important;
}

/* ✅ HILANGKAN SCROLLBAR (TAPI MASIH BISA SCROLL) */
.table-container {
    -ms-overflow-style: none;  /* IE & Edge */
    scrollbar-width: none;     /* Firefox */
}

.table-container::-webkit-scrollbar {
    display: none;             /* Chrome, Safari */
}


/* OPTIONAL biar lebih rapi */
.table thead th {
    position: sticky;
    top: 0;
    background: #f5f5f5;
}

/* ✅ HILANGKAN ABU-ABU */
.card .table-container {
    background: transparent !important;
}
</style>


<div class="container-fluid" style="padding-left:260px; padding-top:10px;">

    <!-- ✅ KOTAK RINGKASAN -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center" style="background:#608fb1;">
                <h6>Total Anggota</h6>
                <h4>{{ $totalAnggota }}</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center" style="background:#e18d2e;">
                <h6>Total Peminjaman</h6>
                <h4>{{ $totalPinjam }}</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center" style="background:#b84040;">
                <h6>Total Pengembalian</h6>
                <h4>{{ $totalKembali }}</h4>
            </div>
        </div>
    </div>
    <!-- ✅ END KOTAK -->

    <div class="card shadow-sm p-4" style="background:#f5f5f5; color:#333; overflow:hidden;">
        <h6>Riwayat peminjam baru</h6>

        <div class="table-container">
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
</div>
@endsection
