<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun untuk Admin Utama (jika ada)
        User::create([
            'name' => 'Admin Cafe',
            'email' => 'admin@cafeampalu.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password aman Anda
            'role' => 'admin',
        ]);

        // Akun untuk Kasir
        User::create([
            'name' => 'Kasir Satu',
            'email' => 'kasir@cafeampalu.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password aman Anda
            'role' => 'kasir',
        ]);

        // Akun untuk Admin Dapur
        User::create([
            'name' => 'Admin Dapur',
            'email' => 'dapur@cafeampalu.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password aman Anda
            'role' => 'dapur',
        ]);
    }
}
