@extends('layouts.kepala.app')

@section('content')

<style>
.container-data{
    max-width:1000px;
    margin:40px auto;
    font-family: Arial, Helvetica, sans-serif;

    margin-left:300px;
}

.card-data{
    background:#eceaea;
    padding:25px;
    border-radius:10px;
}

.menu{
    margin-bottom:20px;
    font-size:16px;
}

.menu span{
    cursor:pointer;
}

.active{
    font-weight:bold;
}

.table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

.table th, .table td{
    padding:10px 5px;
    text-align:left;
}

.badge{
    padding:4px 10px;
    border-radius:10px;
    font-size:11px;
    color:white;
}

.hijau{ background:#4CAF50; }
.merah{ background:#f44336; }
.oren{ background:#f39c12; }
.biru{ background:#3498db; } /* 🔥 TAMBAHAN */
</style>

<div class="container-data">

    <div class="menu">
        <span id="btnPinjam" class="active">Daftar Peminjaman</span> |
        <span id="btnKembali">Daftar pengembalian</span>
    </div>

    <div class="card-data">

        <!-- 🔥 TABEL PEMINJAMAN -->
        <div id="peminjamanTable">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal pinjam</th>
                        <th>Jatuh tempo</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $item)
                    @php
                        $today = date('Y-m-d');

                       if(strtolower($item->status) == 'pending'){
                            $status = 'Pending';
                            $class = 'biru';
                        } elseif(strtolower($item->status) == 'dikembalikan' || strtolower($item->status) == 'selesai'){
                            $status = 'Selesai';
                            $class = 'hijau';
                        } elseif(strtolower($item->status) == 'dipinjam'){
                            $status = 'Dipinjam';
                            $class = 'oren';
                        } else {
                            $status = 'Pending';
                            $class = 'biru';
                        }
                    @endphp

                    <tr>
                        <td>{{ $item->judul_buku }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->tanggal_pinjam }}</td>
                        <td>{{ $item->tanggal_jatuh_tempo }}</td>
                        <td><span class="badge {{ $class }}">{{ $status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 🔥 TABEL PENGEMBALIAN -->
        <div id="pengembalianTable" style="display:none;">
            <table class="table">
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
                    @foreach($data as $item)
                    @if(strtolower($item->status) == 'dikembalikan' || strtolower($item->status) == 'selesai')
                    @php
                        if($item->tanggal_kembali > $item->tanggal_jatuh_tempo){
                            $status = 'Terlambat';
                            $class = 'merah';
                        } else {
                            $status = 'Tepat waktu';
                            $class = 'hijau';
                        }
                    @endphp

                    <tr>
                        <td>{{ $item->judul_buku }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->tanggal_pinjam }}</td>
                        <td>{{ $item->tanggal_jatuh_tempo }}</td>
                        <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                        <td>{{ $item->denda ?? '-' }}</td>
                        <td><span class="badge {{ $class }}">{{ $status }}</span></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- 🔥 JAVASCRIPT SWITCH TAB -->
<script>
document.getElementById('btnPinjam').onclick = function(){
    document.getElementById('peminjamanTable').style.display = 'block';
    document.getElementById('pengembalianTable').style.display = 'none';

    this.classList.add('active');
    document.getElementById('btnKembali').classList.remove('active');
}

document.getElementById('btnKembali').onclick = function(){
    document.getElementById('peminjamanTable').style.display = 'none';
    document.getElementById('pengembalianTable').style.display = 'block';

    this.classList.add('active');
    document.getElementById('btnPinjam').classList.remove('active');
}
</script>

@endsection
