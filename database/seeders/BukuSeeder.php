<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota\Buku;

class BukuSeeder extends Seeder
{
    public function run()
    {
        Buku::create([
            'judul' => 'Krudung Merah',
            'pengarang' => 'Broterm Grim',
            'penerbit' => 'Granmedia',
            'tahun_terbit' => 2018,
            'deskripsi' => 'Sinopsis: Seorang ibu meminta Si Tudung Merah mengantarkan makanan ke rumah neneknya yang sedang sakit.',
            'foto' => 'cover1.jpg',
            'stok' => 5
        ]);

        Buku::create([
            'judul' => 'Angkasa',
            'pengarang' => 'Nova Sky',
            'penerbit' => 'Galaxy Press',
            'tahun_terbit' => 2020,
            'deskripsi' => 'Buku tentang penjelajahan luar angkasa dan misteri galaksi.',
            'foto' => 'cover2.jpg',
            'stok' => 3
        ]);

        Buku::create([
            'judul' => 'Bahasa Indonesia',
            'pengarang' => 'Rina Pustaka',
            'penerbit' => 'EduPress',
            'tahun_terbit' => 2019,
            'deskripsi' => 'Panduan lengkap belajar bahasa Indonesia untuk pelajar dan guru.',
            'foto' => 'cover3.jpg',
            'stok' => 2
        ]);

        Buku::create([
            'judul' => 'Adiku',
            'pengarang' => 'M. Hartono',
            'penerbit' => 'Cerita Kita',
            'tahun_terbit' => 2017,
            'deskripsi' => 'Kisah persaudaraan dan petualangan seorang kakak dan adiknya.',
            'foto' => 'cover4.jpg',
            'stok' => 1
        ]);
    }
}
