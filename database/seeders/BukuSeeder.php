<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

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
            'cover' => 'cover1.jpg'
        ]);

        Buku::create([
            'judul' => 'Angkasa',
            'pengarang' => 'Nova Sky',
            'penerbit' => 'Galaxy Press',
            'tahun_terbit' => 2020,
            'deskripsi' => 'Buku tentang penjelajahan luar angkasa dan misteri galaksi.',
            'cover' => 'cover2.jpg'
        ]);

        Buku::create([
            'judul' => 'Bahasa Indonesia',
            'pengarang' => 'Rina Pustaka',
            'penerbit' => 'EduPress',
            'tahun_terbit' => 2019,
            'deskripsi' => 'Panduan lengkap belajar bahasa Indonesia untuk pelajar dan guru.',
            'cover' => 'cover3.jpg'
        ]);

        Buku::create([
            'judul' => 'Adiku',
            'pengarang' => 'M. Hartono',
            'penerbit' => 'Cerita Kita',
            'tahun_terbit' => 2017,
            'deskripsi' => 'Kisah persaudaraan dan petualangan seorang kakak dan adiknya.',
            'cover' => 'cover4.jpg'
        ]);
    }
}
