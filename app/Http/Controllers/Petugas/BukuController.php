<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Buku;
use App\Models\Petugas\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // ✅ TAMBAHAN

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('page.petugas.buku.index', compact('buku'));
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.petugas.buku.detail', compact('buku'));
    }

    public function create()
    {
        return view('page.petugas.buku.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('foto');
        $data['penerbit'] = $request->penerbit ?? '-';

        $cekBuku = Buku::where('judul', $request->judul)
                        ->where('pengarang', $request->pengarang)
                        ->first();

        if ($cekBuku) {
            return back()->with('error', 'Buku sudah ada!');
        }

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');
            $namaFile = $file->getClientOriginalName();

            $data['foto'] = $file->store('buku', 'public');
        }

        Buku::create($data);

        return redirect()->route('petugas.buku.index');
    }

    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['buku', 'user'])->get();
        return view('page.petugas.peminjaman.index', compact('peminjaman'));
    }

    public function acc($id)
    {
        $data = Peminjaman::find($id);
        $data->status = 'dipinjam';
        $data->save();

        return back();
    }

    public function tolak($id)
    {
        $data = Peminjaman::find($id);
        $data->status = 'ditolak';
        $data->save();

        return back();
    }

    public function kembalikan($id)
    {
        $data = Peminjaman::findOrFail($id);

        $data->tanggal_kembali = now();
        $data->status = 'dikembalikan';

        $data->save();

        return back();
    }
    public function terima($id)
{
    $data = Peminjaman::findOrFail($id);

    $kembali = Carbon::parse($data->tanggal_kembali);
    $tempo = Carbon::parse($data->tanggal_jatuh_tempo);

    // tentukan denda
    if ($kembali->gt($tempo)) {
        $data->denda = 5000;
    } else {
        $data->denda = 0;
    }

    // 🔥 WAJIB INI
    $data->status = 'selesai';

    $data->save();

    return back();
}


public function pengembalian()
{
    $data = Peminjaman::whereNotNull('tanggal_kembali')->get();

    return view('page.petugas.data_pengembalian.index', compact('data'));
}


    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.petugas.buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        if ($request->hasFile('foto')) {

            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }

            $path = $request->file('cover')->store('buku', 'public');

            $buku->foto = $path;
        }

        $buku->judul = $request->judul;
        $buku->pengarang = $request->pengarang;
        $buku->penerbit = $request->penerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->stok = $request->stok;

        $buku->save();

        return redirect()->route('petugas.buku.index');
    }

    public function delete($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->foto) {
           Storage::disk('public')->delete($buku->foto);
        }

        $buku->delete();

        return redirect()->back();
    }

    public function anggota()
{
    $anggota = User::where('role', 'anggota')->get(); // ✅ FIX

    return view('page.petugas.data anggota.index', compact('anggota'));
}


    public function deleteAnggota($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return back();
    }

    public function deletePengembalian($id)
    {
        $data = Peminjaman::findOrFail($id);
        $data->delete();

        return back();
    }
}
