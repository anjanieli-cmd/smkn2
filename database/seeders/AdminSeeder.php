<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun admin default.
     *
     * GANTI email & password di bawah ini sebelum dipakai di production.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@smkn2mojokerto.sch.id'],
            [
                'name'     => 'Admin SKANEDA',
                'password' => Hash::make('admin12345'),
                // kalau tabel users punya kolom role, aktifkan baris ini:
                // 'role'  => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}