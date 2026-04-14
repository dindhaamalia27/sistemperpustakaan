<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Peminjaman;

class LaporanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['buku','user'])->get();
        return view('page.kepala.laporan.index', compact('data'));
    }

    public function cetak()
    {
        $data = Peminjaman::with(['buku','user'])->get();
        return view('page.kepala.laporan.cetak', compact('data'));
    }
}
