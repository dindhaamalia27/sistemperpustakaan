<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas\Buku;

class BukuController extends Controller
{

// Method untuk menampilkan data buku
    // Bisa juga sekalian search berdasarkan input user
    public function index(Request $request)
    {
        // Ambil input search dari request (form)
        $search = $request->search;
      // Cari data buku berdasarkan judul, pengarang, atau penerbit
        if ($search) {
            $buku = Buku::where('judul', 'like', '%' . $search . '%')
                        ->orWhere('pengarang', 'like', '%' . $search . '%')
                        ->orWhere('penerbit', 'like', '%' . $search . '%')
                        ->get();
        } else {
            // Kalau tidak ada search, ambil semua data buku
            $buku = Buku::all();
        }
      // Kirim data buku ke view halaman kepala bagian buku
        return view('page.kepala.buku.index', compact('buku'));
    }
   // Method untuk menyimpan data buku baru ke database
    public function store(Request $request)
    {
   // Ambil file foto dari form lalu simpan ke folder storage/public/buku
        $path = $request->file('foto')->store('buku', 'public');
  // Simpan data buku ke database menggunakan model Buku
        \App\Models\Petugas\Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun,
            'foto' => $path,
        ]);
 // Setelah simpan, redirect ke halaman index buku kepala
        return redirect()->route('kepala.buku.index');
    }
}
