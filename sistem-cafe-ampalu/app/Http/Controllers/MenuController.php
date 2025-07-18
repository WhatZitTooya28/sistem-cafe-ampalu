<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order; // <-- Tambahkan ini

class MenuController extends Controller
{
    public function showHome()
    {
        return view('home'); 
    }

    public function showMenu()
    {
        $groupedMenus = Menu::all()->groupBy('category');

        // (BARU) Mengambil pesanan terakhir yang masih aktif untuk meja ini
        $latestOrder = null;
        if (session('table_number')) {
            $latestOrder = Order::where('table_number', session('table_number'))
                                ->whereIn('status', ['menunggu_pembayaran', 'proses', 'siap_diambil'])
                                ->latest()
                                ->first();
        }

        return view('menu', [
            'groupedMenus' => $groupedMenus,
            'latestOrder' => $latestOrder // Kirim data pesanan ke view
        ]);
    }

    public function showDetail(Menu $menu)
    {
        return view('menu-detail', compact('menu'));
    }
}