# Catatan Pertanyaan Coding untuk Uji Kompetensi

## Role Anggota
- **Cara menampilkan daftar buku?**
  - Route: `routes/web.php` route `/buku`.
  - Controller: `App\Http\Controllers\BukuController@index`.
  - View: `resources/views/page/buku/index.blade.php`.

- **Cara mencari buku?**
  - Di `BukuController@index`: query `where` dengan `like` pada `judul`, `pengarang`, dan `penerbit`.
  - Form pencarian ada di `resources/views/page/buku/index.blade.php`.

- **Cara pinjam buku?**
  - Route: `/buku/{id}/pinjam` ke `BukuController@pinjam`.
  - Setelah pilih buku, form submit ke `BukuController@simpanPinjam`.
  - Data disimpan ke model `App\Models\Peminjaman`.

- **Logika tombol pinjam disabled jika stok habis?**
  - View `resources/views/page/buku/index.blade.php` menghitung jumlah `Peminjaman` aktif (`pending`, `dipinjam`).
  - Jika jumlah pinjam aktif >= `stok`, tombol `Pinjam` jadi `disabled`.

- **Cara lihat detail buku?**
  - Route: `/buku/{id}` ke `BukuController@detail`.
  - View: `resources/views/page/buku/detail.blade.php`.

- **Cara lihat peminjaman saya?**
  - Route: `/peminjaman` biasanya ke `PeminjamanController@index`.
  - Query `where('user_id', Auth::id())` untuk peminjaman user saat ini.

- **Cara kembalikan buku?**
  - Route: `/peminjaman/kembalikan/{id}` ke method `kembalikan` di controller.
  - Logika cek status approved, update `tanggal_kembali` dan `denda` otomatis.

## Role Petugas
- **Cara lihat dashboard petugas?**
  - Route: `/petugas/dashboard` ke `App\Http\Controllers\Petugas\DashboardController@index`.
  - Dashboard menghitung total buku, petugas, peminjaman, dan pengembalian.

- **Cara tambah buku?**
  - Route: `/petugas/buku/create` ke `Petugas\BukuController@create`.
  - Form submit ke `Petugas\BukuController@store`.
  - Upload foto buku dan simpan data ke tabel `buku`.

- **Cara edit buku?**
  - Route: `/petugas/buku/edit/{id}` ke `Petugas\BukuController@edit`.
  - Update data lewat `Petugas\BukuController@update`.

- **Cara hapus buku?**
  - Route: `DELETE /petugas/buku/{id}` ke `Petugas\BukuController@delete`.

- **Cara acc peminjaman?**
  - Route: `/petugas/peminjaman/acc/{id}` ke method `acc`.
  - Update status peminjaman ke `dipinjam` dan kurangi `stok` buku.

- **Cara lihat data anggota?**
  - Route biasanya ke controller yang query `User::where('role', 'anggota')`.

## Role Kepala
- **Cara lihat semua data?**
  - Route: `/kepala/dashboard` ke `App\Http\Controllers\Kepala\DashboardController@index`.
  - View menampilkan statistik lengkap.

- **Cara tambah petugas?**
  - Route: `/kepala/tambah-petugas` atau form di panel kepala.
  - Controller: `Kepala\BukuController@createPetugas` atau method serupa.
  - Ada validasi email `unique` untuk mencegah duplikasi.

- **Cara lihat buku kepala?**
  - Route: `/kepala/buku` ke `Kepala\BukuController@index`.
  - Display mirip petugas namun untuk role kepala.

## Umum
- **Model apa yang digunakan?**
  - Buku: `app/Models/Anggota/Buku.php`
  - Peminjaman: `app/Models/Peminjaman.php`
  - User: `app/Models/User.php`

- **Migration penting?**
  - `create_buku_table.php` untuk tabel buku.
  - `create_peminjaman_table.php` untuk tabel peminjaman.
  - `2026_04_08_235810_add_role_to_users_table.php` untuk kolom `role` di tabel users.

- **Validasi di controller?**
  - Gunakan `$request->validate()` di method `store` dan `update`.
  - Aturan umum: `required`, `unique`, `email`, `numeric`.

- **Upload foto buku?**
  - Di `Petugas\BukuController@store`, pakai `$request->file('foto')->store('public')` atau metode serupa.

- **Authentikasi dan role?**
  - Cek `Auth::check()` dan `Auth::user()->role`.
  - Role ditambahkan di register: `role` = `anggota` untuk pendaftaran.

- **Komentar kode?**
  - Gunakan komentar singkat di Blade dan controller.
  - Contoh komentar natural: `// Form pencarian` atau `{{-- Loop daftar buku --}}`.
