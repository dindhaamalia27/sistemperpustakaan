<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'judul_buku',
        'nama',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'status'
    ];
}
