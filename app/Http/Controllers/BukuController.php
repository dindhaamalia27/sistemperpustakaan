<?php

namespace App\Http\Controllers;

use App\Models\Anggota\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class BukuController extends Controller
{
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

    return view('page.buku.index', compact('buku'));
}
    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.buku.detail', compact('buku'));
    }

    public function pinjam($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.buku.pinjam', compact('buku'));
    }

    // SIMPAN DATA PINJAM
    public function simpanPinjam(Request $request)
    {
        // 🔥 AMBIL DATA BUKU
        $buku = Buku::where('judul', $request->judul_buku)->first();

        // 🔥 CEK STOK
        if ($buku && $buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        // 🔥 KURANGI STOK
        if ($buku) {
            $buku->stok -= 1;
            $buku->save();
        }

        Peminjaman::create([
            'judul_buku' => $request->judul_buku,
            'nama' => $request->nama,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'pending'
        ]);

        return redirect('/peminjaman');
    }

    // TAMPILKAN DATA PEMINJAMAN
    public function peminjaman()
    {
        $data = Peminjaman::all();
        return view('page.peminjaman.index', compact('data'));
    }

    // FORM PENGEMBALIAN
    public function formKembali($id)
    {
        $data = Peminjaman::findOrFail($id);
        return view('page.peminjaman.kembalikan', compact('data'));
    }

    // PROSES PENGEMBALIAN
    public function kembalikan(Request $request, $id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        // 🔥 VALIDASI (TAMBAHKAN DI SINI)
        if ($request->tanggal_kembali < $pinjam->tanggal_jatuh_tempo) {
        return back()->with('error', 'Tanggal kembali tidak boleh sebelum jatuh tempo!');
        }

        $pinjam->tanggal_kembali = $request->tanggal_kembali;
        $pinjam->denda = $request->denda;
        $pinjam->status = 'dikembalikan'; // ✅ GANTI DI SINI
        

        $pinjam->save();

        // 🔥 TAMBAH STOK
        $buku = Buku::where('judul', $pinjam->judul_buku)->first();

        if ($buku) {
            $buku->stok += 1;
            $buku->save();
        }

        return redirect('/pengembalian');
    }
}
