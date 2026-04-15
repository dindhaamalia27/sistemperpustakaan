<?php
namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function pdf()
    {
        $data = Peminjaman::with(['buku','user'])->get();

        $pdf = Pdf::loadView('page.kepala.laporan.pdf', compact('data'));

        return $pdf->download('laporan-peminjaman.pdf');
    }
}
