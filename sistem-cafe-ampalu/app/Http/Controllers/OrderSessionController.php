<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderSessionController extends Controller
{
    /**
     * Menyimpan nomor meja dan membatalkan pesanan lama yang belum dibayar.
     */
    public function setTable(Request $request)
    {
        $request->validate(['table_number' => 'required|integer|min:1']);

        // (SOLUSI) Cari pesanan yang 'tergantung' di meja ini
        Order::where('table_number', $request->table_number)
             ->where('status', 'menunggu_pembayaran') // Hanya yang belum dibayar
             ->update(['status' => 'dibatalkan']);    // Batalkan pesanan lama

        // Cek lagi untuk pesanan yang sudah 'diproses'
        $activeOrder = Order::where('table_number', $request->table_number)
                              ->whereIn('status', ['proses', 'siap_diambil'])
                              ->first();

        if ($activeOrder) {
            return redirect()->back()->with('error', 'Meja ' . $request->table_number . ' sedang digunakan dan pesanannya sedang diproses di dapur.');
        }

        // Lanjutkan membuat sesi baru
        $request->session()->forget('customer_name');
        $request->session()->put('table_number', $request->table_number);
        
        return redirect()->route('menu.index');
    }

    /**
     * Menyimpan nama pelanggan dan membatalkan pesanan lama yang belum dibayar.
     */
    public function setCustomerName(Request $request)
    {
        $request->validate(['customer_name' => 'required|string|max:255']);

        // (SOLUSI) Cari pesanan 'take away' yang 'tergantung' dengan nama ini
        Order::where('customer_name', $request->customer_name)
             ->where('status', 'menunggu_pembayaran') // Hanya yang belum dibayar
             ->update(['status' => 'dibatalkan']);    // Batalkan pesanan lama

        // Cek lagi untuk pesanan yang sudah 'diproses'
        $activeOrder = Order::where('customer_name', $request->customer_name)
                              ->whereIn('status', ['proses', 'siap_diambil'])
                              ->first();

        if ($activeOrder) {
            return redirect()->back()->with('error', 'Nama pemesan "' . $request->customer_name . '" memiliki pesanan yang sedang diproses di dapur.');
        }

        // Lanjutkan membuat sesi baru
        $request->session()->forget('table_number');
        $request->session()->put('customer_name', $request->customer_name);

        return redirect()->route('menu.index');
    }
}