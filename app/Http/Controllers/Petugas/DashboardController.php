<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Peminjaman;
use App\Models\Petugas\Buku;
use App\Models\Petugas\Petugas;


class DashboardController extends Controller
{
     // Method untuk menampilkan dashboard petugas
    public function index()
    {
        // Ambil data peminjaman terbaru beserta relasi buku dan user
        $peminjaman = Peminjaman::with(['buku','user'])->latest()->get();

        // Hitung total semua buku
        $totalBuku = Buku::count();

       // Hitung jumlah user dengan role petugas
       $totalpetugas = \App\Models\User::where('role', 'petugas')->count();

       // Hitung total semua peminjaman
       $totalPinjam = Peminjaman::count();

       // Hitung total buku yang sudah dikembalikan (status selesai)
        $totalKembali = Peminjaman::where('status', 'selesai')->count();

        // Kirim semua data ke view dashboard petugas
        return view('page.petugas.dashboard.index', compact(
            'peminjaman',
            'totalBuku',
            'totalpetugas',
            'totalPinjam',
            'totalKembali'
        ));
    }
}
