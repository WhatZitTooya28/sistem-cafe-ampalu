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

        // (DIPERBARUI) Logika untuk mengambil pesanan terakhir
        $latestOrder = null;
        $tableNumber = session('table_number');
        $customerName = session('customer_name');

        // Membuat query dasar
        $query = Order::whereIn('status', ['menunggu_pembayaran', 'proses', 'siap_diambil']);

        // Menambahkan kondisi berdasarkan sesi yang ada
        if ($tableNumber) {
            $query->where('table_number', $tableNumber);
        } elseif ($customerName) {
            $query->where('customer_name', $customerName);
        }
        
        // Hanya eksekusi query jika ada sesi yang valid
        if ($tableNumber || $customerName) {
            $latestOrder = $query->latest()->first();
        }

        return view('menu', [
            'groupedMenus' => $groupedMenus,
            'latestOrder' => $latestOrder
        ]);
    }

    public function showDetail(Menu $menu)
    {
        return view('menu-detail', compact('menu'));
    }
}