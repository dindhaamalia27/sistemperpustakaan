<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas\Buku; // 🔥 WAJIB TAMBAH INI

class BukuController extends Controller
{

// ✅ TAMBAHKAN DI SINI (PALING ATAS)
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $buku = Buku::where('judul', 'like', '%' . $search . '%')
                        ->orWhere('pengarang', 'like', '%' . $search . '%')
                        ->orWhere('penerbit', 'like', '%' . $search . '%')
                        ->get();
        } else {
            $buku = Buku::all();
        }

        return view('page.kepala.buku.index', compact('buku')); // 🔥 SESUAI HALAMAN KEPALA
    }

    public function store(Request $request)
    {
        $path = $request->file('foto')->store('buku', 'public');

        \App\Models\Petugas\Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun,
            'foto' => $path,
        ]);

        return redirect()->route('petugas.buku.index');
    }
}
