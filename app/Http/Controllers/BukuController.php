<?php

namespace App\Http\Controllers;

use App\Models\Anggota\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth; // Import untuk autentikasi
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Method untuk menampilkan daftar buku dengan fitur pencarian
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

    // Method untuk menampilkan detail buku
    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.buku.detail', compact('buku'));
    }

    // Method untuk halaman pinjam buku
    public function pinjam($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.buku.pinjam', compact('buku'));
    }

    // Method untuk menyimpan data peminjaman
    public function simpanPinjam(Request $request)
    {

        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $request->validate([
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
        ]);

        // 🔥 AMBIL DATA BUKU
        $buku = Buku::where('judul', $request->judul_buku)->first();

        // 🔥 CEK STOK
        if ($buku && $buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        // 🔥 TAMBAHAN (AMBIL USER SEKARANG BIAR GA KETUKER)
        $user = Auth::user();

        Peminjaman::create([
            'buku_id' => $request->buku_id,
            'user_id' => $user->id,
            'judul_buku' => $request->judul_buku,
            'nama' => $user->nama ?? $user->name,
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

        if ($pinjam->status !== 'dipinjam') {
            return back()->with('error', 'Buku hanya bisa dikembalikan setelah disetujui dan dalam status dipinjam.');
        }

        $tanggalKembali = date('Y-m-d');
        $tanggalJatuhTempo = $pinjam->tanggal_jatuh_tempo;
        $denda = 0;

        if ($tanggalKembali > $tanggalJatuhTempo) {
            $selisih = (new \DateTime($tanggalKembali))->diff(new \DateTime($tanggalJatuhTempo))->days;
            $denda = $selisih * 5000;
        }

        $pinjam->tanggal_kembali = $tanggalKembali;
        $pinjam->denda = $denda;
        $pinjam->status = 'dikembalikan';

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
