<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== PETUGAS (Kepala & Petugas) =====
        DB::table('users')->insert([
            [
                'name'       => 'Kepala Perpustakaan',
                'email'      => 'kepala@perpustakaan.com',
                'password'   => Hash::make('kepala123'),
                'role'       => 'kepala',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Petugas Satu',
                'email'      => 'petugas@perpustakaan.com',
                'password'   => Hash::make('petugas123'),
                'role'       => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ===== USERS (Anggota) =====
        DB::table('users')->insert([
            [
                'name'              => 'Anggota Satu',
                'email'             => 'anggota@perpustakaan.com',
                'password'          => Hash::make('anggota123'),
                'email_verified_at' => now(),
                'login_count'       => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
