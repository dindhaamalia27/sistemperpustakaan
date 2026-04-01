<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Model;
use App\Models\Petugas\Peminjaman; // ⬅️ tambahin ini

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'cover',
        'stok'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id'); // ⬅️ FIX disini
    }
}
