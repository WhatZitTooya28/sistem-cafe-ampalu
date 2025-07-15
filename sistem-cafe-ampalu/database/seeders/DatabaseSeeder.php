<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil MenuSeeder Anda di sini
        $this->call([
            MenuSeeder::class,
            UserSeeder::class,
        ]);
    }
}