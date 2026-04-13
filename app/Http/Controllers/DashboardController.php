<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    // Method untuk menampilkan halaman dashboard
    public function index()
    {
        // Mengambil data peminjaman terbaru (diurutkan dari yang paling baru)
        $data = Peminjaman::latest()->get();

        // Menghitung jumlah user dengan role anggota
        $totalAnggota = User::where('role', 'anggota')->count();

        // Menghitung total seluruh data peminjaman
        $totalPinjam = Peminjaman::count();

        // Menghitung jumlah peminjaman yang sudah selesai (dikembalikan)
        $totalKembali = Peminjaman::where('status', 'selesai')->count();

        // Mengirim semua data ke view dashboard
        return view('page.dashboard.index', compact(
            'data',
            'totalAnggota',
            'totalPinjam',
            'totalKembali'
        ));
    }
}
