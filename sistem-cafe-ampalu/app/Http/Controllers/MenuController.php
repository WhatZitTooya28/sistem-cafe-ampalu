<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function showHome()
    {
        return view('home'); 
    }

    public function showMenu()
    {
        // Ambil semua menu dan kelompokkan berdasarkan kolom 'category'
        $groupedMenus = Menu::all()->groupBy('category');

        // Kirim data yang sudah dikelompokkan ke view 'menu'
        return view('menu', ['groupedMenus' => $groupedMenus]);
    }

        public function showDetail(Menu $menu)
    {
        // Mengirim data menu yang dipilih ke view baru
        return view('menu-detail', compact('menu'));
    }
}