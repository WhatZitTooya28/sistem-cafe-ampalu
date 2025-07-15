<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Menu::create(['name' => 'Strawberry MILK', 'price' => 18000, 'category' => 'Non-Coffee', 'description' => 'Susu segar rasa stroberi.']);
        Menu::create(['name' => 'Nasi Goreng Kampung', 'price' => 20000, 'category' => 'Foods', 'description' => 'Nasi goreng spesial bumbu rahasia.']);
    }
}
