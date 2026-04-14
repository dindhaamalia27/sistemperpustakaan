<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Buku;
use App\Models\Petugas\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BukuController extends Controller
{

    // Menampilkan daftar buku + fitur search
    public function index(Request $request)
    {
        // Ambil input search dari user
        $search = $request->search;

        // Jika ada input search
        if ($search) {
            // Cari berdasarkan judul, pengarang, atau penerbit
            $buku = Buku::where('judul', 'like', '%' . $search . '%')
                        ->orWhere('pengarang', 'like', '%' . $search . '%')
                        ->orWhere('penerbit', 'like', '%' . $search . '%')
                        ->get();
        } else {
            // Jika tidak ada search, tampilkan semua buku
            $buku = Buku::all();
        }

        // Kirim data ke view
        return view('page.petugas.buku.index', compact('buku'));
    }

    // Menampilkan detail buku berdasarkan ID
    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.petugas.buku.detail', compact('buku'));
    }

    // Menampilkan halaman form tambah buku
    public function create()
    {
        return view('page.petugas.buku.create');
    }

    // Menyimpan data buku baru
    public function store(Request $request)
    {
        // Ambil semua data kecuali foto
        $data = $request->except('foto');

        // Jika penerbit kosong, isi dengan '-'
        $data['penerbit'] = $request->penerbit ?? '-';

        // Cek apakah buku sudah ada (judul + pengarang sama)
        $cekBuku = Buku::where('judul', $request->judul)
                        ->where('pengarang', $request->pengarang)
                        ->first();

        if ($cekBuku) {
            return back()->with('error', 'Buku sudah ada!');
        }

        // Jika ada file foto
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');
            $namaFile = $file->getClientOriginalName(); // ambil nama asli file

            // Simpan file ke storage/public/buku
            $data['foto'] = $file->store('buku', 'public');
        }

        // Simpan ke database
        Buku::create($data);

        return redirect()->route('petugas.buku.index');
    }

    // Menampilkan data peminjaman beserta relasi buku & user
    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['buku', 'user'])->get();
        return view('page.petugas.peminjaman.index', compact('peminjaman'));
    }

    // ACC peminjaman (setujui pinjam)
    public function acc($id)
    {
        $data = Peminjaman::find($id);

        // Jika data tidak ditemukan
        if (!$data) {
            return back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Ambil data buku
        $buku = Buku::find($data->buku_id);

        // Cek stok buku
        if ($buku && $buku->stok <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia untuk disetujui.');
        }

        // Kurangi stok jika ada buku
        if ($buku) {
            $buku->stok -= 1;
            $buku->save();
        }

        // Update status jadi dipinjam
        $data->status = 'dipinjam';
        $data->save();

        return back();
    }

    // Menolak peminjaman
    public function tolak($id)
    {
        $data = Peminjaman::find($id);
        $data->status = 'ditolak';
        $data->save();

        return back();
    }

    // Proses pengembalian oleh anggota (set tanggal kembali)
    public function kembalikan($id)
    {
        $data = Peminjaman::findOrFail($id);

        $data->tanggal_kembali = now(); // waktu sekarang
        $data->status = 'dikembalikan';

        $data->save();

        return back();
    }

    // Petugas menerima pengembalian + hitung denda final
    public function terima($id)
    {
        $data = Peminjaman::findOrFail($id);

        $data->status = 'selesai';
        $data->save();

        // Tambah stok buku kembali hanya jika kondisi baik
        if ($data->kondisi === 'baik') {
            $buku = \App\Models\Petugas\Buku::find($data->buku_id);
            if ($buku) {
                $buku->stok += 1;
                $buku->save();
            }
        }

        return back();
    }

    // Menolak pengembalian
    public function tolakPengembalian($id)
    {
        $data = Peminjaman::findOrFail($id);

        // Reset data pengembalian
        $data->tanggal_kembali = null;
        $data->kondisi = null;
        $data->denda = null;
        // status tetap dipinjam

        $data->save();

        return back();
    }

    // Menampilkan data pengembalian
    public function pengembalian()
    {
        $data = Peminjaman::whereNotNull('tanggal_kembali')->get();

        return view('page.petugas.data pengembalian.index', compact('data'));
    }

    // Cetak struk pengembalian
    public function cetakStruk($id)
    {
        $data = Peminjaman::findOrFail($id);
        return view('page.petugas.data pengembalian.struk', compact('data'));
    }

    // Menampilkan form edit buku
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.petugas.buku.edit', compact('buku'));
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        // Validasi stok tidak boleh minus
        if ($request->stok < 0) {
            return back();
        }

        // Validasi input
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $buku = Buku::findOrFail($id);

        // Jika upload foto baru
        if ($request->file('foto')) {

            $file = $request->file('foto');

            // Cek apakah foto lama ada
            if ($buku->foto && Storage::disk('public')->exists($buku->foto)) {

                $fileLama = Storage::disk('public')->path($buku->foto);

                // Bandingkan file lama dan baru (biar gak sama)
                if (md5_file($file->getRealPath()) === md5_file($fileLama)) {
                    return back()->with('error', 'Foto yang sama tidak boleh diupload');
                }
            }

            // Hapus foto lama
            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }

            // Simpan foto baru
            $path = $file->store('buku', 'public');
            $buku->foto = $path;
        }

        // Update data buku
        $buku->judul = $request->judul;
        $buku->pengarang = $request->pengarang;
        $buku->penerbit = $request->penerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;

        $buku->save();

        return redirect()->route('petugas.buku.index');
    }

    // Hapus buku
   public function delete($id)
   {
    $buku = Buku::findOrFail($id);

    // cek apakah buku masih dipinjam (belum dikembalikan)
    $masihDipinjam = Peminjaman::where('buku_id', $id)
                        ->whereNull('tanggal_kembali')
                        ->exists();

    // jika buku sedang di pinjam tidak bisa di hapus
    if ($masihDipinjam) {
        return redirect()->back()->with('error', 'Buku sedang dipinjam, tidak bisa dihapus!');
    }

    // Hapus foto jika ada
    if ($buku->foto) {
        Storage::disk('public')->delete($buku->foto);
    }

    // Hapus buku
    $buku->delete();

    return redirect()->back()->with('success', 'Buku berhasil dihapus');
}

    // Menampilkan data anggota
    public function anggota()
    {
        $anggota = User::where('role', 'anggota')->get();

        return view('page.petugas.data anggota.index', compact('anggota'));
    }

    // Hapus anggota
    public function deleteAnggota($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return back();
    }

    // Hapus data pengembalian
    public function deletePengembalian($id)
    {
        $data = Peminjaman::findOrFail($id);
        $data->delete();

        return back();
    }
}
