<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = \App\Models\Petugas\Buku::count();

        $totalAnggota = \App\Models\User::where('role', 'anggota')->count();

        $totalPeminjaman = \App\Models\Peminjaman::count();

        $totalPengembalian = \App\Models\Peminjaman::whereNotNull('tanggal_kembali')->count();

        return view('page.kepala.dashboard.index', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalPengembalian'
        ));
    }
}
