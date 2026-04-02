<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Buku;
use App\Models\Petugas\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        $data = $request->except('cover');

        if ($request->hasFile('cover')) {
            $data['foto'] = $request->file('cover')->store('buku', 'public');
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
        $data = Peminjaman::find($id);
        $data->status = 'dikembalikan';
        $data->save();

        return back();
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.petugas.buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        if ($request->hasFile('cover')) {

            if ($buku->foto) {
                Storage::disk('public')->delete($buku->foto);
            }

            $path = $request->file('cover')->store('buku', 'public');

            $buku->foto = $path;
        }

        $buku->judul = $request->judul;
        $buku->pengarang = $request->pengarang;
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
}
