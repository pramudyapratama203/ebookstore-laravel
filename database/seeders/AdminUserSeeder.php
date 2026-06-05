<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@ebookstore.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'joined' => now(), // REVISI: Isi kolom joined secara otomatis dengan tanggal & jam saat ini
        ]);
    }
}