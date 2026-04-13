<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // Method untuk menampilkan halaman dashboard kepala
    public function index()
    {
        // Menghitung total semua data buku di database
        $totalBuku = \App\Models\Petugas\Buku::count();

        // Menghitung jumlah user yang memiliki role sebagai anggota
        $totalAnggota = \App\Models\User::where('role', 'anggota')->count();

        // Menghitung total semua data peminjaman
        $totalPeminjaman = \App\Models\Peminjaman::count();

         // Menghitung total pengembalian (yang sudah memiliki tanggal_kembali)
        $totalPengembalian = \App\Models\Peminjaman::whereNotNull('tanggal_kembali')->count();

        // Mengirim semua data ke view dashboard kepala
        return view('page.kepala.dashboard.index', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalPengembalian'
        ));
    }
}
