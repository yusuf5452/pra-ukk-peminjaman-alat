<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'), // Password default: password
            'role' => 'admin',
        ]);

        // 2. Akun Petugas
        User::create([
            'nama' => 'Petugas Jaga',
            'username' => 'petugas',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);

        // 3. Akun Peminjam (User Biasa)
        User::create([
            'nama' => 'Budi Pendaki',
            'username' => 'budi123',
            'password' => Hash::make('peminjam123'),
            'role' => 'peminjam',
        ]);
    }
}