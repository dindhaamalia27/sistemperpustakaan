<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Buku;
use App\Models\Petugas\Peminjaman;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Daftar buku
    public function index()
    {
        $buku = Buku::all();
        return view('page.petugas.buku.index', compact('buku'));
    }

    // Detail buku
    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.petugas.buku.detail', compact('buku'));
    }

    // Create buku
    public function create()
    {
        return view('page.petugas.buku.create');
    }

    // Simpan buku
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('buku', 'public');
        }

        Buku::create($data);

        return redirect()->route('petugas.buku.index');
    }

    // Daftar peminjaman (relasi buku & user)
    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['buku', 'user'])->get();
        return view('page.petugas.peminjaman.index', compact('peminjaman'));
    }

    // ⬇️ TAMBAHAN (JANGAN DIUBAH YANG ATAS)
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

    // ⬇️ INI YANG KAMU MINTA (DITAMBAHIN DI PALING BAWAH)
    public function kembalikan($id)
    {
        $data = Peminjaman::find($id);
        $data->status = 'dikembalikan';
        $data->save();

        return back();
    }

    // ⬇️ FITUR EDIT (TAMBAHAN PALING BAWAH BANGET)
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.petugas.buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('buku', 'public');
        }

        $buku->update($data);

        return redirect()->route('petugas.buku.index')->with('success', 'Buku berhasil diupdate');
    }
}
