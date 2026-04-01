<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController; // ✅ FIX
use App\Http\Controllers\Petugas\BukuController as PetugasBukuController;
use Illuminate\Support\Facades\Route;

// ================= LOGIN =================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.proses');

// ================= REGISTER =================
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.proses');

// ================= DASHBOARD =================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ======= DASHBOARD PETUGAS =======
Route::prefix('petugas')->name('petugas.')->group(function () {

    // Redirect root petugas ke dashboard
    Route::get('/', function () {
        return redirect()->route('petugas.dashboard.index');
    });

    // ✅ Dashboard Petugas (SUDAH FIX)
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard.index');

   // ===== Buku Petugas =====
   Route::get('/buku', [PetugasBukuController::class, 'index'])->name('buku.index');
   Route::get('/buku/create', [PetugasBukuController::class, 'create'])->name('buku.create');
   Route::post('/buku/store', [PetugasBukuController::class, 'store'])->name('buku.store');
   Route::get('/buku/detail/{id}', [PetugasBukuController::class, 'detail'])->name('buku.detail');
   Route::delete('/buku/{id}', [PetugasBukuController::class, 'destroy'])->name('buku.delete');

   Route::get('/buku/edit/{id}', [PetugasBukuController::class, 'edit'])->name('buku.edit');
   Route::put('/buku/update/{id}', [PetugasBukuController::class, 'update'])->name('buku.update');

    // Peminjaman petugas
    Route::get('/peminjaman', [PetugasBukuController::class,'peminjaman'])->name('peminjaman.index');
    Route::get('/acc/{id}', [PetugasBukuController::class, 'acc'])->name('acc');
    Route::get('/tolak/{id}', [PetugasBukuController::class, 'tolak'])->name('tolak');

    // Pengembalian
    Route::get('/pengembalian', function () {
        $data = \App\Models\Peminjaman::whereNotNull('tanggal_kembali')->get();
        return view('page.pengembalian.index', compact('data'));
    })->name('pengembalian.index');

    // Denda
    Route::get('/denda', function () {
        return "halaman denda";
    })->name('denda.index');
});


// ================= BUKU =================
Route::get('/buku', [BukuController::class,'index'])->name('buku.index');
Route::get('/buku/{id}/pinjam', [BukuController::class,'pinjam'])->name('buku.pinjam');
Route::get('/buku/{id}', [BukuController::class,'detail'])->name('buku.detail');

// ================= PEMINJAMAN =================
Route::post('/pinjam/simpan', [BukuController::class,'simpanPinjam'])->name('pinjam.simpan');
Route::get('/peminjaman', [BukuController::class,'peminjaman'])->name('peminjaman.index');
Route::get('/peminjaman/{id}/form-kembali', [BukuController::class,'formKembali'])->name('peminjaman.formkembali');
Route::post('/peminjaman/{id}/kembalikan', [BukuController::class,'kembalikan'])->name('peminjaman.kembalikan');

// ================= PENGEMBALIAN =================
Route::get('/pengembalian', function () {
    $data = \App\Models\Peminjaman::whereNotNull('tanggal_kembali')->get();
    return view('page.pengembalian.index', compact('data'));
})->name('pengembalian.index');

// ================= LOGOUT =================
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// ROOT
Route::get('/', function () {
    return redirect('/login');
});
