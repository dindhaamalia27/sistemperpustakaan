<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BukuController extends Controller
{
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
