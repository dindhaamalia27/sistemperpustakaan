<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController; // ✅ FIX
use App\Http\Controllers\Petugas\BukuController as PetugasBukuController;
use App\Http\Controllers\Kepala\DashboardController as KepalaDashboardController; // ✅ TAMBAHAN
use App\Http\Controllers\Kepala\BukuController as KepalaBukuController; // ✅ TAMBAHAN

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

    // Dashboard Petugas
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard.index');

   // ===== Buku Petugas =====
   Route::get('/buku', [PetugasBukuController::class, 'index'])->name('buku.index');
   Route::get('/buku/create', [PetugasBukuController::class, 'create'])->name('buku.create');
   Route::post('/buku/store', [PetugasBukuController::class, 'store'])->name('buku.store');
   Route::get('/buku/detail/{id}', [PetugasBukuController::class, 'detail'])->name('buku.detail');
   Route::delete('/buku/{id}', [PetugasBukuController::class, 'delete'])->name('buku.delete');
   Route::get('/buku/edit/{id}', [PetugasBukuController::class, 'edit'])->name('buku.edit');
   Route::put('/buku/update/{id}', [PetugasBukuController::class, 'update'])->name('buku.update');

   // ===== ✅ TAMBAHKAN DI SINI (Data Anggota) =====
   Route::get('/anggota', [PetugasBukuController::class, 'anggota'])->name('anggota.index');
   Route::delete('/anggota/{id}', [PetugasBukuController::class, 'deleteAnggota'])->name('anggota.delete');

    // Peminjaman petugas
    Route::get('/peminjaman', [PetugasBukuController::class,'peminjaman'])->name('peminjaman.index');
    Route::get('/acc/{id}', [PetugasBukuController::class, 'acc'])->name('acc');
    Route::get('/tolak/{id}', [PetugasBukuController::class, 'tolak'])->name('tolak');


   //pengembalian petugas
    Route::get('/pengembalian', function () {
        $data = \App\Models\Petugas\Peminjaman::whereNotNull('tanggal_kembali')->get();
    return view('page.petugas.data pengembalian.index', compact('data')); })->name('pengembalian.index');
    Route::post('/pengembalian/{id}/terima', [PetugasBukuController::class, 'terima'])->name('pengembalian.terima');
    Route::post('/pengembalian/{id}/tolak', [PetugasBukuController::class, 'tolak'])->name('pengembalian.tolak');
    Route::delete('/pengembalian/{id}', [PetugasBukuController::class, 'deletePengembalian'])->name('pengembalian.destroy');

    // Denda
    Route::get('/denda', function () {
        return "halaman denda";
    })->name('denda.index');
});


       // ======= DASHBOARD KEPALA =======
    Route::prefix('kepala')->name('kepala.')->group(function () {

    Route::get('/dashboard', [KepalaDashboardController::class, 'index'])->name('dashboard.index');

    // ====== Buku kepala =====
     Route::get('/buku', [KepalaBukuController::class, 'index'])->name('buku.index');

        // ✅ TAMBAH DI SINI
    Route::get('/buku/{id}', function ($id) {
    $buku = \App\Models\Petugas\Buku::findOrFail($id);
    return view('page.kepala.buku.detail', compact('buku'));
    })->name('buku.detail');

    Route::get('/peminjaman', function () {
    return view('page.kepala.peminjaman.index');})->name('peminjaman.index');

    Route::get('/anggota', function () {
        return view('page.kepala.anggota.index'); })->name('anggota.index');

    Route::get('/laporan', function () {
    $data = \App\Models\Peminjaman::all(); // 🔥 ambil data
    return view('page.kepala.laporan.index', compact('data'));
     })->name('laporan.index');

    // ======Tambah petugas ==
        Route::get('/petugas', function () {
        $petugas = \App\Models\User::where('role', 'petugas')->get();
        return view('page.kepala.tambah petugas.index', compact('petugas'));})->name('petugas.index');

        Route::get('/petugas/create', function () {
      return view('page.kepala.tambah petugas.create');
     })->name('petugas.create');

     // ✅ TAMBAHAN (INI DOANG YANG DITAMBAH)
    Route::post('/petugas', function (\Illuminate\Http\Request $request) {
        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'petugas'
        ]);

        return redirect()->route('kepala.petugas.index');
    })->name('petugas.store');

    // 🔥 TARO DI SINI ↓↓↓

    // EDIT
    Route::get('/petugas/{id}/edit', function ($id) {
    $petugas = \App\Models\User::findOrFail($id);
    return view('page.kepala.tambah petugas.edit', compact('petugas'));
    })->name('petugas.edit');

    // UPDATE
   Route::put('/petugas/{id}', function (\Illuminate\Http\Request $request, $id) {
    $petugas = \App\Models\User::findOrFail($id);

    $petugas->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);
  return redirect()->route('kepala.petugas.index');

  })->name('petugas.update');

  // HAPUS
    Route::delete('/petugas/{id}', function ($id) {
    $petugas = \App\Models\User::findOrFail($id);
    $petugas->delete();

   return redirect()->route('kepala.petugas.index');
   })->name('petugas.destroy');

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
