<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Peminjaman::latest()->get();

        // ✅ TAMBAHAN
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalPinjam = Peminjaman::count();
        $totalKembali = Peminjaman::where('status', 'selesai')->count();

        return view('page.dashboard.index', compact(
            'data',
            'totalAnggota',
            'totalPinjam',
            'totalKembali'
        ));
    }
}
