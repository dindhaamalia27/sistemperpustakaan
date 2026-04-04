<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Peminjaman;
use App\Models\Petugas\Buku;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['buku','user'])->latest()->get();

        $totalBuku = Buku::count();


         $totalAnggota = User::where('role', 'anggota')->count();
        $totalPinjam = Peminjaman::count();

            return view('page.petugas.dashboard.index', compact(
            'peminjaman',
            'totalBuku',
            'totalAnggota',
            'totalPinjam'
        ));
    }
}
