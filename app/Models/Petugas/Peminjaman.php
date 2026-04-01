<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Model;
use App\Models\Petugas\Buku;
use App\Models\User;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'buku_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'status'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
