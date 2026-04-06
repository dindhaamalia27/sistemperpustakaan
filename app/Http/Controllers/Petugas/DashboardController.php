<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Peminjaman;
use App\Models\Petugas\Buku;
use App\Models\Petugas\Petugas; // ✅ TAMBAHAN


class DashboardController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['buku','user'])->latest()->get();

        $totalBuku = Buku::count();

        // ✅ FIX: total petugas (bukan nama)
       $totalpetugas = \App\Models\User::where('role', 'petugas')->count();
       $totalPinjam = Peminjaman::count();
        // ✅ TAMBAHAN
        $totalKembali = Peminjaman::where('status', 'selesai')->count();

        return view('page.petugas.dashboard.index', compact(
            'peminjaman',
            'totalBuku',
            'totalpetugas',
            'totalPinjam',
            'totalKembali'
        ));
    }
}
