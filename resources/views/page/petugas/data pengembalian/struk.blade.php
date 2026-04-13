@extends('layouts.petugas.app')

@section('content')

<style>
    @media print {
        .left-sidebar,
        .header,
        .footer,
        .top-bar,
        .btn,
        .btn-primary,
        .btn-secondary,
        .d-flex.justify-content-between,
        .sidebar-nav,
        .sidebar-item,
        .sidebar-link {
            display: none !important;
        }

        body {
            margin: 0 !important;
            padding: 0 !important;
        }

        .page-wrapper,
        .body-wrapper,
        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }

        .card {
            box-shadow: none !important;
            border: none !important;
        }
    }
</style>

<div class="top-bar"></div>

<div class="container-fluid" style="padding-left:260px; padding-top:30px;">
    <div class="card p-4 shadow-sm border-0" style="border-radius:15px; background:#fff; max-width:700px; margin:auto;">
        <h4 class="mb-3">Struk Pengembalian Buku</h4>
        <div style="border:1px dashed #ccc; padding:20px; border-radius:12px;">
            <div style="margin-bottom:16px; font-size:14px; color:#555;">
                <strong>Nama anggota:</strong> {{ $data->nama }}<br>
                <strong>Judul buku:</strong> {{ $data->judul_buku }}<br>
                <strong>Kondisi:</strong> {{ ucfirst($data->kondisi ?? '-') }}<br>
            </div>

            <table style="width:100%; font-size:14px;">
                <tr>
                    <td style="padding:8px 0; width:35%">Tanggal pinjam</td>
                    <td style="padding:8px 0;">: {{ $data->tanggal_pinjam }}</td>
                </tr>
                <tr>
                    <td style="padding:8px 0;">Jatuh tempo</td>
                    <td style="padding:8px 0;">: {{ $data->tanggal_jatuh_tempo }}</td>
                </tr>
                <tr>
                    <td style="padding:8px 0;">Tanggal kembali</td>
                    <td style="padding:8px 0;">: {{ $data->tanggal_kembali ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding:8px 0;">Status</td>
                    <td style="padding:8px 0;">: {{ $data->status }}</td>
                </tr>
                <tr>
                    <td style="padding:8px 0;">Denda</td>
                    <td style="padding:8px 0;">: Rp {{ number_format($data->denda ?? 0, 0, ',', '.') }}</td>
                </tr>
            </table>

            <div style="margin-top:24px; font-size:13px; color:#333;">
                <strong>Catatan:</strong><br>
                - Denda akan dihitung berdasarkan kondisi buku.
                @if($data->kondisi === 'baik')
                    Jika terlambat, biaya Rp 5.000 / hari.
                @elseif($data->kondisi === 'rusak')
                    Denda tetap Rp 30.000.
                @elseif($data->kondisi === 'hilang')
                    Denda tetap Rp 100.000.
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="button" class="btn btn-primary" onclick="window.print();">Cetak Struk</button>
        </div>
    </div>
</div>

@endsection
